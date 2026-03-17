<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Gallery\Pages;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Service;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\DateRange;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use App\MoonShine\Resources\Gallery\GalleryResource;
use MoonShine\Support\ListOf;
use Throwable;


/**
 * @extends IndexPage<GalleryResource>
 */
class GalleryIndexPage extends IndexPage
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
            Select::make('Device', 'device_id')
                ->options(Device::pluck('type', 'id')->toArray())
                ->nullable(),
            Select::make('Brand', 'brand_id')
                ->options(Brand::pluck('name', 'id')->toArray())
                ->nullable(),
            Select::make('Service', 'service_id')
                ->options(Service::pluck('name', 'id')->toArray())
                ->nullable(),
            DateRange::make('Published between', 'published_at'),
            Switcher::make('Has Image', 'has_image')
                ->onApply(function ($query, $value) {
                    if (! $value) {
                        return $query;
                    }

                    return $query->hasImage();
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
