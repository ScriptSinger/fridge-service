<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Price;

use Illuminate\Database\Eloquent\Model;
use App\Models\Price;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Price\Pages\PriceIndexPage;
use App\MoonShine\Resources\Price\Pages\PriceFormPage;
use App\MoonShine\Resources\Price\Pages\PriceDetailPage;
use App\MoonShine\Resources\Service\ServiceResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Price, PriceIndexPage, PriceFormPage, PriceDetailPage>
 */
class PriceResource extends ModelResource
{
    protected string $model = Price::class;

    protected string $title = 'Prices';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(
                'Service',
                'service',
                fn($item) => $item->name,
                ServiceResource::class
            )->sortable(),

            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->sortable(),

            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            )->sortable(),
            Number::make('Price From', 'price_from')->sortable(),
            Number::make('Price To', 'price_to')->sortable(),
            Text::make('Units', 'units'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            BelongsTo::make(
                'Service',
                'service',
                fn($item) => $item->name,
                ServiceResource::class
            )->searchable()
                ->required(),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            ),
            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            )->nullable(),

            Number::make('Price From', 'price_from'),
            Number::make('Price To', 'price_to'),
            Text::make('Units', 'units')->default('₽'),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            BelongsTo::make(
                'Service',
                'service',
                fn($item) => $item->name,
                ServiceResource::class
            )->searchable()
                ->required(),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            ),
            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            )->nullable(),

            Number::make('Price From', 'price_from'),
            Number::make('Price To', 'price_to'),
            Text::make('Units', 'units')->default('₽'),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            PriceIndexPage::class,
            PriceFormPage::class,
            PriceDetailPage::class,
        ];
    }
}
