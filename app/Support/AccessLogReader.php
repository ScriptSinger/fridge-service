<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use SplFileObject;

/**
 * Reads the JSON lines written by AccessLogMiddleware (channel `access`).
 *
 * Entry ids are "<file basename>:<zero-based line>". Both the list and
 * find() open files with the same flags, so a line number always points at
 * the same entry in either place.
 */
class AccessLogReader
{
    public function __construct(private ?string $directory = null)
    {
    }

    /**
     * @return list<string> absolute paths, newest file first
     */
    public function files(): array
    {
        $dir = $this->directory ?? storage_path('logs');

        $files = glob($dir . '/access-*.log') ?: [];

        if (is_file($dir . '/access.log')) {
            $files[] = $dir . '/access.log';
        }

        $files = array_values(array_unique($files));

        usort($files, fn (string $a, string $b) => filemtime($b) <=> filemtime($a));

        return $files;
    }

    /**
     * @return list<string>
     */
    public function fileNames(): array
    {
        return array_map('basename', $this->files());
    }

    /**
     * `since` (unix timestamp) skips whole files untouched since then, so the
     * dashboard does not parse two weeks of logs to count the last day.
     *
     * @param  array{since?: ?int, file?: ?string, date_from?: ?string, date_to?: ?string, path?: ?string, ip?: ?string, exclude_ip?: ?string, user_agent?: ?string, only_bots?: mixed, only_suspicious?: mixed, only_slow?: mixed}  $filters
     * @return Collection<int, array<string, mixed>>
     */
    public function entries(array $filters = []): Collection
    {
        $file = (string) ($filters['file'] ?? '');
        $files = $this->files();

        if ($file !== '' && $file !== 'all') {
            $files = array_values(array_filter($files, fn (string $path) => basename($path) === $file));
        }

        $since = isset($filters['since']) ? (int) $filters['since'] : null;

        if ($since !== null) {
            $files = array_values(array_filter($files, fn (string $path) => filemtime($path) >= $since));
        }

        $from = $this->filterDate($filters['date_from'] ?? null, true);
        $to = $this->filterDate($filters['date_to'] ?? null, false);

        $rows = [];

        foreach ($files as $path) {
            $object = new SplFileObject($path, 'r');
            $object->setFlags(SplFileObject::DROP_NEW_LINE);

            foreach ($object as $line) {
                if (! is_string($line) || $line === '') {
                    continue;
                }

                $decoded = json_decode($line, true);
                if (! is_array($decoded)) {
                    continue;
                }

                $row = $this->row(basename($path), $object->key(), $decoded);

                if ($this->matches($row, $filters, $from, $to)) {
                    $rows[] = $row;
                }
            }
        }

        return new Collection($rows);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function find(string $id): ?array
    {
        [$name, $line] = array_pad(explode(':', $id, 2), 2, null);

        if ($name === null || $line === null || ! ctype_digit($line)) {
            return null;
        }

        foreach ($this->files() as $path) {
            if (basename($path) !== $name) {
                continue;
            }

            $object = new SplFileObject($path, 'r');
            $object->setFlags(SplFileObject::DROP_NEW_LINE);
            $object->seek((int) $line);

            $raw = $object->current();
            $decoded = is_string($raw) ? json_decode($raw, true) : null;

            if (! is_array($decoded) || $object->key() !== (int) $line) {
                return null;
            }

            return $this->row($name, (int) $line, $decoded) + [
                'raw' => json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ];
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $decoded
     * @return array<string, mixed>
     */
    private function row(string $file, int $line, array $decoded): array
    {
        $context = Arr::get($decoded, 'context');
        $context = is_array($context) ? $context : [];

        $time = $this->parseTime(Arr::get($decoded, 'datetime'));

        return [
            'id' => $file . ':' . $line,
            'file' => $file,
            'time' => $time?->format('d.m.Y H:i:s'),
            'time_sort' => $time?->getTimestamp() ?? 0,
            'request_id' => (string) Arr::get($context, 'request_id'),
            'method' => (string) Arr::get($context, 'method'),
            'path' => (string) Arr::get($context, 'path'),
            'query' => (string) Arr::get($context, 'query'),
            'status' => (int) Arr::get($context, 'status'),
            'duration_ms' => (int) Arr::get($context, 'duration_ms'),
            'response_size' => Arr::get($context, 'response_size'),
            'ip' => (string) Arr::get($context, 'ip'),
            'user_agent' => (string) Arr::get($context, 'user_agent'),
            'referer' => (string) Arr::get($context, 'referer'),
            'admin_user_id' => Arr::get($context, 'admin_user_id'),
            'is_slow' => (bool) Arr::get($context, 'slow_request'),
            'is_bot' => (bool) Arr::get($context, 'is_bot'),
            'is_suspicious' => (bool) Arr::get($context, 'is_suspicious'),
        ];
    }

    /**
     * @param  array<string, mixed>  $row
     * @param  array<string, mixed>  $filters
     */
    private function matches(array $row, array $filters, ?Carbon $from, ?Carbon $to): bool
    {
        foreach (['path', 'ip', 'user_agent'] as $key) {
            $needle = trim((string) ($filters[$key] ?? ''));

            if ($needle !== '' && ! str_contains((string) $row[$key], $needle)) {
                return false;
            }
        }

        // Exact addresses, comma/space separated: the admin's own IP, monitors.
        $excluded = preg_split('/[\s,]+/', (string) ($filters['exclude_ip'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);

        if ($excluded && in_array($row['ip'], $excluded, true)) {
            return false;
        }

        foreach (['only_bots' => 'is_bot', 'only_suspicious' => 'is_suspicious', 'only_slow' => 'is_slow'] as $filter => $flag) {
            if ($this->truthy($filters[$filter] ?? false) && ! $row[$flag]) {
                return false;
            }
        }

        if (isset($filters['since']) && $row['time_sort'] < (int) $filters['since']) {
            return false;
        }

        if ($from || $to) {
            if ($row['time_sort'] === 0) {
                return false;
            }

            if ($from && $row['time_sort'] < $from->getTimestamp()) {
                return false;
            }

            if ($to && $row['time_sort'] > $to->getTimestamp()) {
                return false;
            }
        }

        return true;
    }

    private function truthy(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    private function parseTime(mixed $value): ?Carbon
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        try {
            return Carbon::parse($value)->timezone(config('app.timezone'));
        } catch (\Throwable) {
            return null;
        }
    }

    private function filterDate(mixed $value, bool $startOfDay): ?Carbon
    {
        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        try {
            $date = Carbon::parse(trim($value), config('app.timezone'));
        } catch (\Throwable) {
            return null;
        }

        return $startOfDay ? $date->startOfDay() : $date->endOfDay();
    }
}
