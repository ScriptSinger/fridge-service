<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Text;

class AccessLogs extends Page
{
    private const int MAX_ENTRIES = 100;

    public function getTitle(): string
    {
        return $this->title ?: 'Access Logs';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $statusFilter = (string) request()->query('status', 'all');
        $allowedStatuses = ['all', '200', '404', '500'];

        if (! in_array($statusFilter, $allowedStatuses, true)) {
            $statusFilter = 'all';
        }

        $entries = $this->loadEntries($statusFilter === 'all' ? null : (int) $statusFilter);

        return [
            Box::make('Filters', [
                $this->buildStatusFilters($statusFilter),
            ]),
            Box::make('Latest entries', [
                $this->buildTable($entries),
            ]),
        ];
    }

    private function buildStatusFilters(string $active): Flex
    {
        $options = ['all' => 'All', '200' => '200', '404' => '404', '500' => '500'];
        $links = [];

        foreach ($options as $key => $label) {
            $url = $this->getUrl();
            if ($key !== 'all') {
                $url .= '?status=' . $key;
            }

            $link = Link::make($url, $label)->button();
            if ($key === $active) {
                $link->filled();
            }
            $links[] = $link;
        }

        return Flex::make($links)->class('gap-2');
    }

    private function buildTable(array $entries): TableBuilder
    {
        return TableBuilder::make([
            Text::make('Time', 'time'),
            Text::make('Method', 'method'),
            Text::make('Path', 'path'),
            Text::make('Status', 'status'),
            Text::make('Duration ms', 'duration_ms'),
            Text::make('Resp size', 'response_size'),
            Text::make('IP', 'ip'),
            Text::make('Bot', 'is_bot'),
            Text::make('Suspicious', 'is_suspicious'),
        ], $entries)->withoutKey();
    }

    private function loadEntries(?int $statusFilter): array
    {
        $file = $this->getLatestLogFile();
        if (! $file) {
            return [];
        }

        $lines = @file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (! is_array($lines)) {
            return [];
        }

        $entries = [];
        foreach (array_reverse($lines) as $line) {
            $decoded = json_decode($line, true);
            if (! is_array($decoded)) {
                continue;
            }

            $context = Arr::get($decoded, 'context', []);
            if (! is_array($context)) {
                $context = [];
            }

            $status = Arr::get($context, 'status');
            if ($statusFilter !== null && (int) $status !== $statusFilter) {
                continue;
            }

            $entries[] = [
                'time' => Arr::get($decoded, 'datetime'),
                'method' => Arr::get($context, 'method'),
                'path' => Arr::get($context, 'path'),
                'status' => $status,
                'duration_ms' => Arr::get($context, 'duration_ms'),
                'response_size' => Arr::get($context, 'response_size'),
                'ip' => Arr::get($context, 'ip'),
                'is_bot' => Arr::get($context, 'is_bot') ? 'yes' : 'no',
                'is_suspicious' => Arr::get($context, 'is_suspicious') ? 'yes' : 'no',
            ];

            if (count($entries) >= self::MAX_ENTRIES) {
                break;
            }
        }

        return $entries;
    }

    private function getLatestLogFile(): ?string
    {
        $dir = storage_path('logs');
        $candidates = glob($dir . '/access-*.log') ?: [];

        $single = $dir . '/access.log';
        if (File::exists($single)) {
            $candidates[] = $single;
        }

        if (empty($candidates)) {
            return null;
        }

        usort($candidates, fn(string $a, string $b) => filemtime($b) <=> filemtime($a));

        return $candidates[0] ?? null;
    }
}
