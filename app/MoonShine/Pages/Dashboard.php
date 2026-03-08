<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Lead;
use App\Models\Gallery;
use App\Models\Page as ContentPage;
use App\Models\Review;
use App\Models\Service;
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
        $leadsTotal = $this->safeCount(Lead::class);
        $leadsToday = $this->safeCountToday(Lead::class);
        $publishedReviews = $this->safeCount(Review::class, ['is_published' => true]);
        $galleriesTotal = $this->safeCount(Gallery::class);
        $publishedGalleries = $this->safeCountBeforeNow(Gallery::class, 'published_at');
        $activePages = $this->safeCount(ContentPage::class, ['is_active' => true]);
        $activeServices = $this->safeCount(Service::class, ['is_active' => true]);

        return [
            Heading::make('Overview', 2),
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
}
