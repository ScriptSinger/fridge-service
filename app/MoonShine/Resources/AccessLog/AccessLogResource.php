<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\AccessLog;

use App\MoonShine\Resources\AccessLog\Pages\AccessLogDetailPage;
use App\MoonShine\Resources\AccessLog\Pages\AccessLogIndexPage;
use App\Support\AccessLogReader;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\Core\TypeCasts\DataCasterContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Crud\QueryTags\QueryTag;
use MoonShine\Crud\Resources\CrudResource;
use MoonShine\Support\Enums\Action;
use MoonShine\Support\Enums\Color;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Fields\Preview;
use MoonShine\UI\Fields\Text;

/**
 * Read-only view over storage/logs/access-*.log (see AccessLogReader).
 *
 * @extends CrudResource<\MoonShine\Contracts\Core\DependencyInjection\CoreContract, array<string, mixed>, AccessLogIndexPage, null, AccessLogDetailPage>
 */
class AccessLogResource extends CrudResource
{
    protected string $title = 'Access Logs';

    protected string $sortColumn = 'time_sort';

    protected SortDirection $sortDirection = SortDirection::DESC;

    protected int $itemsPerPage = 50;

    protected function pages(): array
    {
        return [
            AccessLogIndexPage::class,
            AccessLogDetailPage::class,
        ];
    }

    protected function activeActions(): ListOf
    {
        return new ListOf(Action::class, [Action::VIEW]);
    }

    public function getCaster(): DataCasterContract
    {
        return new AccessLogCaster();
    }

    public function getItems(): LengthAwarePaginator
    {
        $filters = $this->getFilterParams();

        if (filter_var($filters['hide_my_ip'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
            $filters['exclude_ip'] = trim(($filters['exclude_ip'] ?? '') . ' ' . request()->ip());
        }

        $rows = app(AccessLogReader::class)->entries($filters);

        /** @var QueryTag $tag */
        foreach ($this->getQueryTags() as $tag) {
            if ($tag->isActive()) {
                $rows = $tag->apply($rows);
                break;
            }
        }

        [$column, $direction] = $this->prepareOrder();

        $rows = $rows
            ->sortBy($column, SORT_REGULAR, $direction === 'desc')
            ->values();

        $pageName = $this->getQueryParamName('page');
        $page = max($this->getPaginatorPage(), 1);

        return (new LengthAwarePaginator(
            $rows->forPage($page, $this->getItemsPerPage())->values(),
            $rows->count(),
            $this->getItemsPerPage(),
            $page,
            ['path' => Paginator::resolveCurrentPath(), 'pageName' => $pageName],
        ))->appends($this->getQueryParams()->except($pageName)->toArray());
    }

    public function findItem(bool $orFail = false): ?DataWrapperContract
    {
        $row = app(AccessLogReader::class)->find((string) $this->getItemID());

        if ($row === null) {
            $orFail && abort(404);

            return null;
        }

        return $this->getCaster()->cast($row);
    }

    public function massDelete(array $ids): void
    {
        //
    }

    public function delete(DataWrapperContract $item, ?FieldsContract $fields = null): bool
    {
        return false;
    }

    public function save(DataWrapperContract $item, ?FieldsContract $fields = null): DataWrapperContract
    {
        return $item;
    }

    protected function indexFields(): iterable
    {
        return [
            Text::make('Время', 'time')->sortable('time_sort'),
            Text::make('Метод', 'method')->sortable(),
            Text::make('Путь', 'path')->sortable(),
            Preview::make('Статус', 'status', fn (array $row) => (string) Badge::make(
                (string) $row['status'],
                $this->statusColor($row['status']),
            ))->sortable(),
            Text::make('мс', 'duration_ms')->sortable(),
            Preview::make('Флаги', 'is_suspicious', fn (array $row) => $this->flags($row))->sortable(),
            Text::make('IP', 'ip')->sortable(),
            Text::make('User-Agent', 'user_agent')->sortable(),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Время', 'time'),
            Text::make('Request ID', 'request_id'),
            Text::make('Файл', 'file'),
            Text::make('Метод', 'method'),
            Text::make('Путь', 'path'),
            Text::make('Query string', 'query'),
            Preview::make('Статус', 'status', fn (array $row) => (string) Badge::make(
                (string) $row['status'],
                $this->statusColor($row['status']),
            )),
            Text::make('Длительность, мс', 'duration_ms'),
            Text::make('Размер ответа', 'response_size'),
            Text::make('IP', 'ip'),
            Text::make('User-Agent', 'user_agent'),
            Text::make('Referer', 'referer'),
            Text::make('Admin user ID', 'admin_user_id'),
            Preview::make('Флаги', 'is_suspicious', fn (array $row) => $this->flags($row)),
            Preview::make('Запись', 'raw', fn (array $row) => '<pre style="white-space:pre-wrap">' . e($row['raw']) . '</pre>'),
        ];
    }

    private function statusColor(int $status): Color
    {
        return match (intdiv($status, 100)) {
            2 => Color::SUCCESS,
            3 => Color::INFO,
            4 => Color::WARNING,
            5 => Color::ERROR,
            default => Color::SECONDARY,
        };
    }

    /**
     * @param  array<string, mixed>  $row
     */
    private function flags(array $row): string
    {
        $badges = array_filter([
            $row['is_suspicious'] ? Badge::make('suspicious', Color::ERROR) : null,
            $row['is_slow'] ? Badge::make('slow', Color::WARNING) : null,
            $row['is_bot'] ? Badge::make('bot', Color::SECONDARY) : null,
        ]);

        return implode(' ', array_map('strval', $badges));
    }
}
