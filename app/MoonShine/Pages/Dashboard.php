<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\MoonShine\Resources\AccessLog\AccessLogResource;
use App\MoonShine\Resources\Lead\LeadResource;
use App\Support\AccessLogReader;
use App\Support\AuthLogReader;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\MenuManager\Attributes\SkipMenu;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Preview;

/**
 * Answers "what needs attention now": four numbers, each a link to the list
 * behind it, and the queue of leads nobody has picked up yet.
 */
#[SkipMenu]
class Dashboard extends Page
{
    private const int QUEUE_SIZE = 5;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $leads = app(LeadResource::class);
        $accessLogs = app(AccessLogResource::class);

        $since = now()->subDay()->getTimestamp();
        $newLeads = Lead::query()->where('status', LeadStatus::New->value)->count();
        $today = $this->leadsBetween(now()->startOfDay(), now());
        $yesterday = $this->leadsBetween(now()->subDay()->startOfDay(), now()->subDay()->endOfDay());
        $serverErrors = app(AccessLogReader::class)
            ->entries(['since' => $since])
            ->filter(static fn (array $row): bool => $row['status'] >= 500)
            ->count();
        $failedLogins = app(AuthLogReader::class)->failedLoginsSince($since);

        return [
            Grid::make([
                $this->tile(
                    $this->link($leads->getIndexPageUrl(['filter[status]' => LeadStatus::New->value]), 'Новые заявки'),
                    $newLeads,
                    'inbox',
                    $newLeads > 0 ? Color::WARNING : Color::GRAY,
                ),
                $this->tile("Заявок сегодня (вчера {$yesterday})", $today, 'calendar-days', Color::PRIMARY),
                $this->tile(
                    $serverErrors > 0
                        ? $this->link($accessLogs->getIndexPageUrl(['query-tag' => '5xx']), 'Ошибки 5xx за 24 ч')
                        : 'Ошибки 5xx за 24 ч',
                    $serverErrors,
                    'exclamation-circle',
                    $serverErrors > 0 ? Color::ERROR : Color::GRAY,
                ),
                $this->tile('Неудачных входов за 24 ч', $failedLogins, 'shield-exclamation', $failedLogins > 0 ? Color::ERROR : Color::GRAY),
            ]),
            Box::make('Ждут ответа', [
                $this->queue(),
                Link::make($leads->getIndexPageUrl(['filter[status]' => LeadStatus::New->value]), 'Все новые заявки →')
                    ->customAttributes(['class' => 'mt-4']),
            ]),
        ];
    }

    private function tile(string $label, int $value, string $icon, Color $color): Column
    {
        return Column::make([
            ValueMetric::make($label)->icon($icon)->iconColor($color)->value($value),
        ], 3);
    }

    private function link(string $url, string $label): string
    {
        return (string) Link::make($url, $label);
    }

    private function leadsBetween(CarbonInterface $from, CarbonInterface $to): int
    {
        return Lead::query()
            ->where('status', '!=', LeadStatus::Irrelevant->value)
            ->whereBetween('created_at', [$from, $to])
            ->count();
    }

    private function queue(): ComponentContract
    {
        $leads = app(LeadResource::class);

        $rows = Lead::query()
            ->where('status', LeadStatus::New->value)
            ->with('leadable')
            ->latest()
            ->limit(self::QUEUE_SIZE)
            ->get()
            ->map(static fn (Lead $lead): array => [
                'id' => $lead->getKey(),
                'age' => $lead->created_at->locale('ru')->diffForHumans(syntax: CarbonInterface::DIFF_ABSOLUTE, short: true),
                'stale' => $lead->created_at->lt(Carbon::now()->subDay()),
                'who' => trim(($lead->name ?: '—') . ' ' . $lead->phone),
                'source' => trim($lead->channel_label . ' · ' . ($lead->leadable?->title ?? $lead->leadable?->name ?? '')),
                'url' => $leads->getFormPageUrl($lead->getKey()),
            ])
            ->all();

        if ($rows === []) {
            return Heading::make('Новых заявок нет', 6);
        }

        return TableBuilder::make([
            Preview::make('Ждёт', 'age', static fn (array $row): string => $row['stale']
                ? (string) Badge::make($row['age'], Color::WARNING)
                : e($row['age'])),
            Preview::make('Контакт', 'who', static fn (array $row): string => (string) Link::make($row['url'], e($row['who']))),
            Preview::make('Откуда', 'source', static fn (array $row): string => e($row['source'])),
        ], $rows)->simple();
    }
}
