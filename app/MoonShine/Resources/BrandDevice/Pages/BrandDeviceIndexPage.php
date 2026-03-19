<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\BrandDevice\Pages;

use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\BrandDevice\BrandDeviceResource;
use MoonShine\Support\ListOf;
use Throwable;

/**
 * @extends IndexPage<BrandDeviceResource>
 */
class BrandDeviceIndexPage extends IndexPage
{
    protected bool $isLazy = true;

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
            Text::make('H1', 'h1'),
            Text::make('Title', 'title'),
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
