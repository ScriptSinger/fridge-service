<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Lead;
use App\Models\Gallery;
use App\Models\Page as ContentPage;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
#[\MoonShine\MenuManager\Attributes\SkipMenu]

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
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
        $accessMetrics = $this->calculateAccessMetrics();
        $leadsTotal = $this->safeCount(Lead::class);
        $leadsToday = $this->safeCountToday(Lead::class);
        $publishedReviews = $this->safeCount(Review::class, ['is_published' => true]);
        $galleriesTotal = $this->safeCount(Gallery::class);
        $publishedGalleries = $this->safeCountBeforeNow(Gallery::class, 'published_at');
        $activePages = $this->safeCount(ContentPage::class, ['is_active' => true]);
        $activeServices = $this->safeCount(Service::class, ['is_active' => true]);

        return [
            Box::make('Access Logs (24h)', [
                Grid::make([
                    Column::make([
                        ValueMetric::make('Total')
                            ->icon('globe-alt')
                            ->value($accessMetrics['total']),
                    ], 3),
                    Column::make([
                        ValueMetric::make('4xx')
                            ->icon('exclamation-triangle')
                            ->value($accessMetrics['errors_4xx']),
                    ], 3),
                    Column::make([
                        ValueMetric::make('5xx')
                            ->icon('exclamation-circle')
                            ->value($accessMetrics['errors_5xx']),
                    ], 3),
                    Column::make([
                        ValueMetric::make('Bots %')
                            ->icon('cpu-chip')
                            ->value($accessMetrics['bot_share']),
                    ], 3),
                    Column::make([
                        ValueMetric::make('Avg ms')
                            ->icon('clock')
                            ->value($accessMetrics['avg_duration_ms']),
                    ], 3),
                    Column::make([
                        ValueMetric::make('Slow requests')
                            ->icon('bolt')
                            ->value($accessMetrics['slow_requests']),
                    ], 3),
                    Column::make([
                        ValueMetric::make('Suspicious')
                            ->icon('shield-exclamation')
                            ->value($accessMetrics['suspicious']),
                    ], 3),
                ]),
            ]),
            Box::make('Overview', [
                Grid::make([
                    Column::make([
                        ValueMetric::make('Leads Total')
                            ->icon('users')
                            ->value($leadsTotal),
                    ], 4),
                    Column::make([
                        ValueMetric::make('Leads Today')
                            ->icon('calendar-days')
                            ->value($leadsToday),
                    ], 4),
                    Column::make([
                        ValueMetric::make('Published Reviews')
                            ->icon('star')
                            ->value($publishedReviews),
                    ], 4),
                    Column::make([
                        ValueMetric::make('Galleries Total')
                            ->icon('photo')
                            ->value($galleriesTotal),
                    ], 6),
                    Column::make([
                        ValueMetric::make('Published Galleries')
                            ->icon('presentation-chart-bar')
                            ->value($publishedGalleries),
                    ], 6),
                    Column::make([
                        ValueMetric::make('Active Pages')
                            ->icon('document-text')
                            ->value($activePages),
                    ], 6),
                    Column::make([
                        ValueMetric::make('Active Services')
                            ->icon('wrench-screwdriver')
                            ->value($activeServices),
                    ], 6),
                ]),
            ]),
            Box::make('Quick note', [
                Heading::make('Use filters in CRUD lists to work with fresh leads and unpublished content.', 6),
            ]),
        ];
    }

    /**
     * @param class-string<\Illuminate\Database\Eloquent\Model> $modelClass
     */
    private function safeCount(string $modelClass, array $where = []): int
    {
        $model = new $modelClass();
        $table = $model->getTable();

        if (! Schema::hasTable($table)) {
            return 0;
        }

        $query = $modelClass::query();

        foreach ($where as $column => $value) {
            $query->where($column, $value);
        }

        return $query->count();
    }

    /**
     * @param class-string<\Illuminate\Database\Eloquent\Model> $modelClass
     */
    private function safeCountToday(string $modelClass): int
    {
        $model = new $modelClass();
        $table = $model->getTable();

        if (! Schema::hasTable($table)) {
            return 0;
        }

        return $modelClass::query()
            ->whereDate('created_at', today())
            ->count();
    }

    /**
     * @param class-string<\Illuminate\Database\Eloquent\Model> $modelClass
     */
    private function safeCountBeforeNow(string $modelClass, string $column): int
    {
        $model = new $modelClass();
        $table = $model->getTable();

        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
            return 0;
        }

        return $modelClass::query()
            ->whereNotNull($column)
            ->where($column, '<=', now())
            ->count();
    }

    /**
     * @return array{total:int, errors_4xx:int, errors_5xx:int, bot_share:string, avg_duration_ms:int}
     */
    private function calculateAccessMetrics(): array
    {
        $cutoff = Carbon::now(config('app.timezone'))->subDay();
        $files = $this->getAccessMetricFiles($cutoff);

        $total = 0;
        $errors4xx = 0;
        $errors5xx = 0;
        $bots = 0;
        $slowRequests = 0;
        $suspicious = 0;
        $durationSum = 0;
        $durationCount = 0;

        foreach ($files as $file) {
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

                $timestamp = Arr::get($decoded, 'datetime');
                if (! $timestamp) {
                    continue;
                }

                try {
                    $time = Carbon::parse($timestamp);
                } catch (\Throwable) {
                    continue;
                }

                if ($time->lt($cutoff)) {
                    continue;
                }

                $context = Arr::get($decoded, 'context', []);
                if (! is_array($context)) {
                    $context = [];
                }

                $total++;

                $status = (int) Arr::get($context, 'status', 0);
                if ($status >= 400 && $status <= 499) {
                    $errors4xx++;
                }
                if ($status >= 500 && $status <= 599) {
                    $errors5xx++;
                }

                if ((bool) Arr::get($context, 'is_bot')) {
                    $bots++;
                }

                if ((bool) Arr::get($context, 'slow_request')) {
                    $slowRequests++;
                }

                if ((bool) Arr::get($context, 'is_suspicious')) {
                    $suspicious++;
                }

                $duration = Arr::get($context, 'duration_ms');
                if (is_numeric($duration)) {
                    $durationSum += (int) $duration;
                    $durationCount++;
                }
            }
        }

        $botShare = $total > 0 ? round(($bots / $total) * 100, 1) . '%' : '0%';
        $avgDuration = $durationCount > 0 ? (int) round($durationSum / $durationCount) : 0;

        return [
            'total' => $total,
            'errors_4xx' => $errors4xx,
            'errors_5xx' => $errors5xx,
            'bot_share' => $botShare,
            'avg_duration_ms' => $avgDuration,
            'slow_requests' => $slowRequests,
            'suspicious' => $suspicious,
        ];
    }

    /**
     * @return list<string>
     */
    private function getAccessMetricFiles(Carbon $cutoff): array
    {
        $dir = storage_path('logs');
        $dates = [
            $cutoff->copy()->format('Y-m-d'),
            Carbon::now(config('app.timezone'))->format('Y-m-d'),
        ];

        $files = [];
        foreach (array_unique($dates) as $date) {
            $path = $dir . '/access-' . $date . '.log';
            if (File::exists($path)) {
                $files[] = $path;
            }
        }

        $single = $dir . '/access.log';
        if (empty($files) && File::exists($single)) {
            $files[] = $single;
        }

        return $files;
    }
}
