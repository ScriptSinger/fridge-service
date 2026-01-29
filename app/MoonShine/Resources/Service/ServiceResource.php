<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service;

use App\Models\Service;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Price\PriceResource;
use App\MoonShine\Resources\Service\Pages\ServiceIndexPage;
use App\MoonShine\Resources\Service\Pages\ServiceFormPage;
use App\MoonShine\Resources\Service\Pages\ServiceDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Service, ServiceIndexPage, ServiceFormPage, ServiceDetailPage>
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Services';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Text::make('Name', 'name')->sortable(),
            Text::make('Description', 'description'),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->sortable(),

            HasMany::make(
                'Prices',
                'prices',
                fn($item) => $item->type,
                PriceResource::class
            )->sortable()
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Text::make('Name', 'name')->required(),
            Textarea::make('Description', 'description'),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->required(),

            HasMany::make('Prices', 'prices')->creatable(),
            // HasMany::make('Problems', 'problems'), // связь через pivot
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Name', 'name')->required(),
            Textarea::make('Description', 'description'),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->required(),

            HasMany::make('Prices', 'prices'),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ServiceIndexPage::class,
            ServiceFormPage::class,
            ServiceDetailPage::class,
        ];
    }
}
