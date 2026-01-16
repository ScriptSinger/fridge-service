<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Page;

use Illuminate\Database\Eloquent\Model;
use App\Models\Page;
use App\MoonShine\Resources\Page\Pages\PageIndexPage;
use App\MoonShine\Resources\Page\Pages\PageFormPage;
use App\MoonShine\Resources\Page\Pages\PageDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Components\Layout\Box;

use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Page, PageIndexPage, PageFormPage, PageDetailPage>
 */
class PageResource extends ModelResource
{
    protected string $model = Page::class;
    protected string $title = 'Pages';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Text::make('Type', 'type'),
            Text::make('Slug', 'slug'),
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

                Text::make('Type', 'type'),

                Text::make('H1', 'h1')
                    ->required(),
                Text::make('Subtitle', 'subtitle')->hint('Подзаголовок / Hero / preview (не менее 105 символов)'),

                Image::make('Hero image', 'image')
                    ->disk('public')
                    ->dir('pages')
                    ->removable()
                    ->hint('720x600'),

                Text::make('Alt для изображения', 'image_alt'),
                Switcher::make('Активна', 'is_active')
                    ->default(true),

            ]),

            Box::make('SEO / Метаданные', [
                Text::make('Title', 'title'),
                Text::make('Description', 'description'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Text::make('Type', 'type'),
            Text::make('Slug', 'slug'),
            Text::make('H1', 'h1'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Title', 'title'),
            Text::make('Description', 'description'),
            Switcher::make('Активна', 'is_active'),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            PageIndexPage::class,
            PageFormPage::class,
            PageDetailPage::class,
        ];
    }
}
