<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Review\Pages;

use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Service\ServiceResource;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\DateRange;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\Review\ReviewResource;
use MoonShine\Support\ListOf;
use Throwable;


/**
 * @extends IndexPage<ReviewResource>
 */
class ReviewIndexPage extends IndexPage
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
            Text::make('Name', 'name'),
            Text::make('City', 'city'),
            Select::make('Source', 'source')
                ->options([
                    'google' => 'Google',
                    'yandex' => 'Yandex',
                    'avito' => 'Avito',
                ])
                ->nullable(),
            Select::make('Rating', 'rating')
                ->options([
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                ])
                ->nullable(),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->searchable()
                ->nullable(),
            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            )->searchable()
                ->nullable(),
            BelongsTo::make(
                'Service',
                'service',
                fn($item) => $item->name,
                ServiceResource::class
            )->searchable()
                ->nullable(),
            DateRange::make('Published between', 'published_at'),
            Switcher::make('Published', 'is_published'),
            Switcher::make('Featured', 'is_featured'),
            Switcher::make('Has Image', 'has_image')
                ->onApply(function ($query, $value) {
                    if (! $value) {
                        return $query;
                    }

                    return $query->whereNotNull('image')->where('image', '!=', '');
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
