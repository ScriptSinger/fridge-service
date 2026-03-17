<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Problem\Pages;

use App\Models\Brand;
use App\Models\Device;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\Problem\ProblemResource;
use MoonShine\Support\ListOf;
use Throwable;


/**
 * @extends IndexPage<ProblemResource>
 */
class ProblemIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    // protected function fields(): iterable
    // {
    //     return [
    //         ID::make(),
    //     ];
    // }

    /**
     * @return ListOf<ActionButtonContract>
     */
    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @return list<FieldContract>
     */
    protected function filters(): iterable
    {
        return [
            Text::make('Title', 'title'),
            Text::make('Slug', 'slug'),
            Select::make('Device', 'device_id')
                ->options(Device::pluck('type', 'id')->toArray())
                ->nullable(),
            Switcher::make('Активна', 'is_active'),
            Select::make('Brand', 'brand_id')
                ->options(Brand::pluck('name', 'id')->toArray())
                ->nullable()
                ->onApply(function ($query, $value) {
                    if ($value === null || $value === '') {
                        return $query;
                    }

                    return $query->whereHas('brands', fn($brandQuery) => $brandQuery->whereKey($value));
                }),
        ];
    }

    /**
     * @return list<QueryTag>
     */
    protected function queryTags(): array
    {
        return [];
    }

    /**
     * @return list<Metric>
     */
    protected function metrics(): array
    {
        return [];
    }

    /**
     * @param  TableBuilder  $component
     *
     * @return TableBuilder
     */
    protected function modifyListComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
