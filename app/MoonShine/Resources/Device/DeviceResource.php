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
use MoonShine\UI\Fields\Textarea;

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
                ->disk('public'),
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
                    ->extension(new CharCount())
                    ->hint('30–60 символов')
                    ->required(),
                Text::make('Subtitle', 'subtitle')
                    ->extension(new CharCount())
                    ->hint('105–120 символов'),
                Switcher::make('Активна', 'is_active')
                    ->default(true),
            ]),

            Box::make([
                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->dir('services')
                    ->hint('Hero / OG image 720x600'),
                Text::make('Alt для изображения', 'image_alt'),
            ]),

            Box::make('SEO / Метаданные', [
                Text::make('Title', 'title')
                    ->extension(new CharCount())
                    ->hint('55–60 (макс 65) символов'),
                Text::make('Description', 'description')
                    ->extension(new CharCount())
                    ->hint('140–160 симоволов'),
            ]),

            Box::make([
                BelongsToMany::make(
                    'Brands',
                    'brands',
                    fn($item) => $item->name,
                    BrandResource::class
                )
                    ->fields([
                        Text::make('H1', 'h1')->extension(new CharCount()),
                        Text::make('Subtitle', 'subtitle')
                            ->extension(new CharCount()),
                        Text::make('Title', 'title')
                            ->extension(new CharCount()),
                        Text::make('Description', 'description')
                            ->extension(new CharCount()),
                    ]),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public'),
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
            )->fields([
                Text::make('H1', 'h1'),
                Textarea::make('Subtitle', 'subtitle'),
                Text::make('Title', 'title'),
                Textarea::make('Description', 'description'),
            ]),
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
