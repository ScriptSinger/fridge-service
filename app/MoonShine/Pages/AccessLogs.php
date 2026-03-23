<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\OffCanvas;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Support\Enums\FormMethod;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;

#[Icon('users')]
#[Group('moonshine::ui.resource.system', 'users', translatable: true)]
#[Order(3)]
class AccessLogs extends Page
{
    private const int MAX_ENTRIES = 100;
    private const int DEFAULT_PAGE = 1;

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

        $filters = $this->getFilters($statusFilter);
        $entriesPayload = $this->loadEntries($filters);
        return [
            Box::make('Filters', [
                $this->buildStatusFilters($statusFilter),
                $this->buildSearchFilters($filters),
            ]),
            Box::make('Latest entries', [
                $this->buildTable($entriesPayload['items']),
                $this->buildPagination($entriesPayload['page'], $entriesPayload['pages'], $filters['status']),
            ]),
            $this->buildEntryComponent()
                ->name('access-log-entry')
                ->canSee(fn() => $this->isEntryComponentRequest()),
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

    private function buildSearchFilters(array $filters): FormBuilder
    {
        $fields = [
            Text::make('Path contains', 'path'),
            Text::make('IP contains', 'ip'),
            Text::make('User Agent contains', 'user_agent'),
            Switcher::make('Only bots', 'only_bots'),
            Switcher::make('Only suspicious', 'only_suspicious'),
        ];

        if ($filters['status'] !== 'all') {
            $fields[] = Hidden::make(column: 'status')->setValue($filters['status']);
        }

        return FormBuilder::make(
            action: $this->getUrl(),
            method: FormMethod::GET,
            fields: $fields,
            values: [
            'path' => $filters['path'],
            'ip' => $filters['ip'],
            'user_agent' => $filters['user_agent'],
            'only_bots' => $filters['only_bots'] ? 1 : 0,
            'only_suspicious' => $filters['only_suspicious'] ? 1 : 0,
        ],
        );
    }

    private function buildPagination(int $page, int $pages, string $status): Flex
    {
        $links = [];
        $base = $this->getUrl();
        $query = $this->buildQueryParams($status);

        if ($page > 1) {
            $links[] = Link::make($base . '?page=' . ($page - 1) . $query, 'Prev')->button();
        }

        if ($page < $pages) {
            $links[] = Link::make($base . '?page=' . ($page + 1) . $query, 'Next')->button();
        }

        $links[] = Text::make('', 'page_info')->setValue("Page {$page} / {$pages}");

        return Flex::make($links)->class('gap-2 mt-4');
    }


    private function buildTable(array $entries): TableBuilder
    {
        return TableBuilder::make([
            Text::make('Time', 'time')->sortable(),
            Text::make('Method', 'method')->sortable(),
            Text::make('Path', 'path')->sortable(),
            Text::make('Status', 'status')->sortable(),
            Text::make('Duration ms', 'duration_ms')->sortable(),
            Text::make('Resp size', 'response_size')->sortable(),
            Text::make('IP', 'ip')->sortable(),
            Text::make('User Agent', 'user_agent')->sortable(),
            Text::make('Bot', 'is_bot')->sortable(),
            Text::make('Suspicious', 'is_suspicious')->sortable(),
            Text::make('Details', 'details')->unescape(),
        ], $entries)->withoutKey()
            ->withNotFound('No log entries found for current filters.');
    }

    private function loadEntries(array $filters): array
    {
        $file = $this->getLatestLogFile();
        if (! $file) {
            return [
                'items' => [],
                'page' => self::DEFAULT_PAGE,
                'pages' => self::DEFAULT_PAGE,
            ];
        }

        $page = max((int) request()->query('page', self::DEFAULT_PAGE), 1);
        $limit = self::MAX_ENTRIES;
        $totalMatches = 0;
        $items = [];
        $fileBasename = basename($file);

        $fileObject = new \SplFileObject($file, 'r');
        $fileObject->setFlags(\SplFileObject::DROP_NEW_LINE | \SplFileObject::SKIP_EMPTY);

        foreach ($fileObject as $line) {
            if (! is_string($line) || $line === '') {
                continue;
            }

            $decoded = json_decode($line, true);
            if (! is_array($decoded)) {
                continue;
            }

            $context = Arr::get($decoded, 'context', []);
            if (! is_array($context)) {
                $context = [];
            }

            if (! $this->matchFilters($context, $filters)) {
                continue;
            }

            $totalMatches++;

            $lineNumber = $fileObject->key();

            $items[] = [
                'line' => $lineNumber,
                'time_raw' => Arr::get($decoded, 'datetime'),
                'time' => $this->formatDateTime(Arr::get($decoded, 'datetime')),
                'method' => Arr::get($context, 'method'),
                'path' => Arr::get($context, 'path'),
                'status' => Arr::get($context, 'status'),
                'duration_ms' => Arr::get($context, 'duration_ms'),
                'response_size' => Arr::get($context, 'response_size'),
                'ip' => Arr::get($context, 'ip'),
                'user_agent' => Arr::get($context, 'user_agent'),
                'is_bot' => Arr::get($context, 'is_bot') ? 'yes' : 'no',
                'is_suspicious' => Arr::get($context, 'is_suspicious') ? 'yes' : 'no',
                'details' => $this->buildDetailsDrawer($fileBasename, $lineNumber, $context),
            ];

        }

        $sort = (string) request()->query('sort', '');
        if ($sort === '') {
            $items = array_reverse($items);
        } else {
            $items = $this->applySort($items);
        }

        $pages = max((int) ceil($totalMatches / $limit), 1);
        $page = min($page, $pages);
        $offset = ($page - 1) * $limit;
        $items = array_slice($items, $offset, $limit);

        return [
            'items' => $items,
            'page' => $page,
            'pages' => $pages,
        ];
    }

    private function buildDetailsDrawer(string $fileBasename, int $lineNumber, array $context): string
    {
        $title = trim((string) Arr::get($context, 'method') . ' ' . (string) Arr::get($context, 'path'));
        if ($title === '') {
            $title = 'Access Log Entry';
        }

        $params = [
            '_component_name' => 'access-log-entry',
            'file' => $fileBasename,
            'line' => $lineNumber,
        ];

        $asyncUrl = route('moonshine.component', ['pageUri' => 'access-logs']) . '?' . http_build_query($params);

        $drawer = OffCanvas::make(
            title: $title,
            content: '',
            toggler: 'Open',
            asyncUrl: $asyncUrl,
        )
            ->name('access-log-entry-' . $lineNumber)
            ->wide();

        return (string) $drawer->render();
    }

    private function applySort(array $items): array
    {
        $sort = (string) request()->query('sort', '');
        if ($sort === '') {
            return $items;
        }

        $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $column = ltrim($sort, '-');

        $allowed = [
            'time',
            'method',
            'path',
            'status',
            'duration_ms',
            'response_size',
            'ip',
            'user_agent',
            'is_bot',
            'is_suspicious',
        ];

        if (! in_array($column, $allowed, true)) {
            return $items;
        }

        usort($items, function (array $a, array $b) use ($column, $direction) {
            $valueA = $column === 'time' ? ($a['time_raw'] ?? null) : ($a[$column] ?? null);
            $valueB = $column === 'time' ? ($b['time_raw'] ?? null) : ($b[$column] ?? null);

            if (in_array($column, ['status', 'duration_ms', 'response_size'], true)) {
                $valueA = (int) $valueA;
                $valueB = (int) $valueB;
            } else {
                $valueA = (string) $valueA;
                $valueB = (string) $valueB;
            }

            $cmp = $valueA <=> $valueB;
            return $direction === 'desc' ? -$cmp : $cmp;
        });

        return $items;
    }

    private function formatDateTime(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        try {
            return Carbon::parse($value)
                ->timezone(config('app.timezone'))
                ->format('d.m.Y H:i:s');
        } catch (\Throwable) {
            return $value;
        }
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

    private function getFilters(string $status): array
    {
        return [
            'status' => $status,
            'path' => (string) request()->query('path', ''),
            'ip' => (string) request()->query('ip', ''),
            'user_agent' => (string) request()->query('user_agent', ''),
            'only_bots' => (bool) request()->query('only_bots', false),
            'only_suspicious' => (bool) request()->query('only_suspicious', false),
        ];
    }

    private function matchFilters(array $context, array $filters): bool
    {
        $status = (int) Arr::get($context, 'status', 0);
        if ($filters['status'] !== 'all' && $status !== (int) $filters['status']) {
            return false;
        }

        $pathNeedle = trim($filters['path']);
        if ($pathNeedle !== '' && ! str_contains((string) Arr::get($context, 'path', ''), $pathNeedle)) {
            return false;
        }

        $ipNeedle = trim($filters['ip']);
        if ($ipNeedle !== '' && ! str_contains((string) Arr::get($context, 'ip', ''), $ipNeedle)) {
            return false;
        }

        $uaNeedle = trim($filters['user_agent']);
        if ($uaNeedle !== '' && ! str_contains((string) Arr::get($context, 'user_agent', ''), $uaNeedle)) {
            return false;
        }

        if ($filters['only_bots'] && ! (bool) Arr::get($context, 'is_bot')) {
            return false;
        }

        if ($filters['only_suspicious'] && ! (bool) Arr::get($context, 'is_suspicious')) {
            return false;
        }

        return true;
    }

    private function buildQueryParams(string $status): string
    {
        $params = [];

        if ($status !== 'all') {
            $params['status'] = $status;
        }

        $path = (string) request()->query('path', '');
        if ($path !== '') {
            $params['path'] = $path;
        }

        $ip = (string) request()->query('ip', '');
        if ($ip !== '') {
            $params['ip'] = $ip;
        }

        $userAgent = (string) request()->query('user_agent', '');
        if ($userAgent !== '') {
            $params['user_agent'] = $userAgent;
        }

        if (request()->query('only_bots')) {
            $params['only_bots'] = 1;
        }

        if (request()->query('only_suspicious')) {
            $params['only_suspicious'] = 1;
        }

        if (empty($params)) {
            return '';
        }

        return '&' . http_build_query($params);
    }

    private function isEntryComponentRequest(): bool
    {
        return request()->routeIs('moonshine.component')
            && request()->query('_component_name') === 'access-log-entry';
    }

    private function buildEntryComponent(): Box
    {
        $file = $this->resolveLogFile((string) request()->query('file', ''));
        $line = max((int) request()->query('line', -1), -1);

        $entry = $this->loadEntry($file, $line);

        $components = [
            \MoonShine\UI\Fields\Textarea::make('Raw', 'raw')
                ->setValue($entry ? $entry['raw'] : ''),
        ];

        $components = array_merge(
            $components,
            $entry ? $this->buildSummaryFields($entry) : [Heading::make('Entry not found.', 6)]
        );

        return Box::make('Access Log Entry', $components);
    }

    /**
     * @return array<string, Text>
     */
    private function buildSummaryFields(array $entry): array
    {
        return [
            Text::make('Time', 'time')->setValue($entry['time'])->readonly(),
            Text::make('Request ID', 'request_id')->setValue($entry['request_id'])->readonly(),
            Text::make('Method', 'method')->setValue($entry['method'])->readonly(),
            Text::make('Path', 'path')->setValue($entry['path'])->readonly(),
            Text::make('Status', 'status')->setValue((string) $entry['status'])->readonly(),
            Text::make('Duration ms', 'duration_ms')->setValue((string) $entry['duration_ms'])->readonly(),
            Text::make('Response Size', 'response_size')->setValue((string) $entry['response_size'])->readonly(),
            Text::make('IP', 'ip')->setValue($entry['ip'])->readonly(),
            Text::make('User Agent', 'user_agent')->setValue($entry['user_agent'])->readonly(),
            Text::make('Referer', 'referer')->setValue($entry['referer'])->readonly(),
            Text::make('Slow', 'slow_request')->setValue($entry['slow_request'])->readonly(),
            Text::make('Bot', 'is_bot')->setValue($entry['is_bot'])->readonly(),
            Text::make('Suspicious', 'is_suspicious')->setValue($entry['is_suspicious'])->readonly(),
        ];
    }

    private function resolveLogFile(string $fileBasename): ?string
    {
        $dir = storage_path('logs');
        $candidates = glob($dir . '/access-*.log') ?: [];

        $single = $dir . '/access.log';
        if (File::exists($single)) {
            $candidates[] = $single;
        }

        if ($fileBasename !== '') {
            $fileBasename = basename($fileBasename);
            foreach ($candidates as $candidate) {
                if (basename($candidate) === $fileBasename) {
                    return $candidate;
                }
            }
        }

        if (empty($candidates)) {
            return null;
        }

        usort($candidates, fn(string $a, string $b) => filemtime($b) <=> filemtime($a));

        return $candidates[0] ?? null;
    }

    private function loadEntry(?string $file, int $line): ?array
    {
        if (! $file || $line < 0) {
            return null;
        }

        $fileObject = new \SplFileObject($file, 'r');
        $fileObject->setFlags(\SplFileObject::DROP_NEW_LINE);

        try {
            $fileObject->seek($line);
        } catch (\Throwable) {
            return null;
        }

        $raw = $fileObject->current();
        if (! is_string($raw) || $raw === '') {
            return null;
        }

        $decoded = json_decode($raw, true);
        if (! is_array($decoded)) {
            return null;
        }

        $context = Arr::get($decoded, 'context', []);
        if (! is_array($context)) {
            $context = [];
        }

        return [
            'time' => $this->formatDateTime(Arr::get($decoded, 'datetime')),
            'request_id' => (string) Arr::get($context, 'request_id'),
            'method' => (string) Arr::get($context, 'method'),
            'path' => (string) Arr::get($context, 'path'),
            'status' => Arr::get($context, 'status'),
            'duration_ms' => Arr::get($context, 'duration_ms'),
            'response_size' => Arr::get($context, 'response_size'),
            'ip' => (string) Arr::get($context, 'ip'),
            'user_agent' => (string) Arr::get($context, 'user_agent'),
            'referer' => (string) Arr::get($context, 'referer'),
            'slow_request' => Arr::get($context, 'slow_request') ? 'yes' : 'no',
            'is_bot' => Arr::get($context, 'is_bot') ? 'yes' : 'no',
            'is_suspicious' => Arr::get($context, 'is_suspicious') ? 'yes' : 'no',
            'raw' => json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ];
    }

}
