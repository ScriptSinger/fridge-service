<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Faq\Pages;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Page;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\Faq\FaqResource;
use MoonShine\Support\ListOf;
use Throwable;


/**
 * @extends IndexPage<FaqResource>
 */
class FaqIndexPage extends IndexPage
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
            Text::make('Question', 'question'),
            Text::make('Answer', 'answer'),
            Select::make('Device', 'device_id')
                ->options(Device::pluck('type', 'id')->toArray())
                ->nullable(),
            Select::make('Brand', 'brand_id')
                ->options(Brand::pluck('name', 'id')->toArray())
                ->nullable(),
            Select::make('Page', 'page_id')
                ->options(Page::pluck('h1', 'id')->toArray())
                ->nullable(),
            Number::make('Sort Order', 'sort_order'),
            Switcher::make('Активна', 'is_active'),
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
