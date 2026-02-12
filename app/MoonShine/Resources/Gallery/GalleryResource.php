<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Gallery;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Gallery\Pages\GalleryIndexPage;
use App\MoonShine\Resources\Gallery\Pages\GalleryFormPage;
use App\MoonShine\Resources\Gallery\Pages\GalleryDetailPage;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Service\ServiceResource;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Gallery, GalleryIndexPage, GalleryFormPage, GalleryDetailPage>
 */
class GalleryResource extends ModelResource
{
    protected string $model = Gallery::class;

    protected string $title = 'Galleries';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')->disk('public'),
            Text::make('Title', 'title')->sortable(),
            Text::make('Subtitle', 'subtitle')->sortable(),
            Number::make('Порядок', 'sort_order')->sortable(),
            BelongsTo::make('Device', 'device', fn($item) => $item->type, DeviceResource::class)->nullable(),
            BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)->nullable(),
            BelongsTo::make('Service', 'service', fn($item) => $item->name, ServiceResource::class)->nullable(),
            BelongsTo::make('Page', 'page', fn($item) => $item->h1, PageResource::class)->nullable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->readonly(),
                Text::make('Title', 'title')->required(),
                Text::make('Subtitle', 'subtitle'),
                Textarea::make('Description', 'description'),
                Number::make('Порядок', 'sort_order')->default(0),
            ]),
            Box::make([
                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->dir('gallery')
                    ->hint('Рекомендуемый размер: 1200x720 px (соотношение 5:3)')
                    ->removable(),
                Text::make('Alt для изображения', 'image_alt'),
            ]),
            Box::make([
                BelongsTo::make('Device', 'device', fn($item) => $item->type, DeviceResource::class)
                    ->nullable()
                    ->searchable(),
                BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)
                    ->nullable()
                    ->searchable(),
                BelongsTo::make('Service', 'service', fn($item) => $item->name, ServiceResource::class)
                    ->nullable()
                    ->searchable(),
                BelongsTo::make('Page', 'page', fn($item) => $item->h1, PageResource::class)
                    ->nullable()
                    ->searchable(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title', 'title'),
            Text::make('Subtitle', 'subtitle'),
            Textarea::make('Description', 'description'),
            Number::make('Порядок', 'sort_order'),
            Image::make('Изображение', 'image')->disk('public'),
            Text::make('Alt для изображения', 'image_alt'),
            BelongsTo::make('Device', 'device', fn($item) => $item->type, DeviceResource::class)->nullable(),
            BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)->nullable(),
            BelongsTo::make('Service', 'service', fn($item) => $item->name, ServiceResource::class)->nullable(),
            BelongsTo::make('Page', 'page', fn($item) => $item->h1, PageResource::class)->nullable(),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            GalleryIndexPage::class,
            GalleryFormPage::class,
            GalleryDetailPage::class,
        ];
    }
}
