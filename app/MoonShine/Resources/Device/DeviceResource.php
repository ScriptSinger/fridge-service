<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Device;

use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\Pages\DeviceIndexPage;
use App\MoonShine\Resources\Device\Pages\DeviceFormPage;
use App\MoonShine\Resources\Device\Pages\DeviceDetailPage;
use Leeto\InputExtensionCharCount\InputExtensions\CharCount;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Device, DeviceIndexPage, DeviceFormPage, DeviceDetailPage>
 */
class DeviceResource extends ModelResource
{
    protected string $model = Device::class;

    protected string $title = 'Devices';

    /**
     * @return list<class-string<PageContract>>
     */

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk(config('filesystems.media')),
            Text::make('Slug', 'slug'),
            Text::make('Постоянная ссылка', 'permalink'),
            Text::make('Type', 'type'),
            Text::make('H1', 'h1'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Title', 'title'),
            Text::make('Description', 'description'),
            Switcher::make('Активна', 'is_active'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->readonly(),
                Text::make('Slug', 'slug')
                    ->readonly()
                    ->hint('Генерируется автоматически'),

                Text::make('Постоянная ссылка', 'permalink'),
                Text::make('Type', 'type'),
                Text::make('H1', 'h1')
                    ->extension(new CharCount(60))
                    ->hint('30–60 символов')
                    ->required(),
                Text::make('Subtitle', 'subtitle')
                    ->extension(new CharCount(120))
                    ->hint('105–120 символов'),
                Switcher::make('Активна', 'is_active')
                    ->default(true),
            ]),

            Box::make([
                Image::make('Изображение', 'image')
                    ->disk(config('filesystems.media'))
                    ->dir('devices')
                    ->hint('Hero / OG image 720x600'),
                Text::make('Alt для изображения', 'image_alt'),
            ]),

            Box::make('SEO / Метаданные', [
                Text::make('Title', 'title')
                    ->extension(new CharCount(65))
                    ->hint('55–60 (макс 65) символов'),
                Text::make('Description', 'description')
                    ->extension(new CharCount(160))
                    ->hint('140–160 симоволов'),
            ]),

            Box::make([
                BelongsToMany::make(
                    'Brands',
                    'brands',
                    fn($item) => $item->name,
                    BrandResource::class
                ),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk(config('filesystems.media')),
            Text::make('Slug', 'slug'),
            Text::make('Постоянная ссылка', 'permalink'),
            Text::make('Type', 'type'),
            Text::make('H1', 'h1'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Title', 'title'),
            Text::make('Description', 'description'),
            Switcher::make('Активна', 'is_active'),

            BelongsToMany::make(
                'Brands',
                'brands',
                fn($item) => $item->name,
                BrandResource::class
            )->readonly(),
        ];
    }

    protected function pages(): array
    {
        return [
            DeviceIndexPage::class,
            DeviceFormPage::class,
            DeviceDetailPage::class,
        ];
    }
}
