<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\MoonShine\Resources\Service\Pages\ServiceIndexPage;
use App\MoonShine\Resources\Service\Pages\ServiceFormPage;
use App\MoonShine\Resources\Service\Pages\ServiceDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\File;
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
            Text::make('Slug', 'slug'),
            Text::make('SEO title', 'title'),
            Text::make('H1', 'h1'),
            Text::make('Meta description', 'description'),
            Text::make('Excerpt', 'excerpt'),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Textarea::make('Контент', 'content'),
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

                Text::make('SEO title', 'title')
                    ->required(),

                Text::make('H1', 'h1')
                    ->required(),

                Text::make('Meta description', 'description'),

                Text::make('Excerpt', 'excerpt')
                    ->hint('Подзаголовок / Hero / preview (не менее 105 символов)'),

                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->hint('Hero / OG image 720x600'),

                Text::make('Alt для изображения', 'image_alt'),

                Textarea::make('Контент', 'content'),

                Switcher::make('Активна', 'is_active')
                    ->default(true),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Slug', 'slug'),
            Text::make('SEO title', 'title'),
            Text::make('H1', 'h1'),
            Text::make('Meta description', 'description'),
            Text::make('Excerpt', 'excerpt'),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Text::make('Alt для изображения', 'image_alt'),
            Textarea::make('Контент', 'content'),
            Switcher::make('Активна', 'is_active'),
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
