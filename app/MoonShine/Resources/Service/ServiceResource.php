<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Service\Pages\ServiceIndexPage;
use App\MoonShine\Resources\Service\Pages\ServiceFormPage;
use App\MoonShine\Resources\Service\Pages\ServiceDetailPage;
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
                    ->required(),
                Text::make('Subtitle', 'subtitle')
                    ->hint('Подзаголовок / Hero / preview (не менее 105 символов)'),
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
                Text::make('Title', 'title'),
                Text::make('Description', 'description'),
            ]),

            Box::make([
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
