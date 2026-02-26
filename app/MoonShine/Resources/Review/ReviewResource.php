<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Review;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\MoonShine\Resources\Review\Pages\ReviewIndexPage;
use App\MoonShine\Resources\Review\Pages\ReviewFormPage;
use App\MoonShine\Resources\Review\Pages\ReviewDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Review, ReviewIndexPage, ReviewFormPage, ReviewDetailPage>
 */
class ReviewResource extends ModelResource
{
    protected string $model = Review::class;

    protected string $title = 'Reviews';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')->sortable(),
            Text::make('City', 'city')->sortable(),
            Text::make('Title', 'title')->sortable(),
            Number::make('Rating', 'rating')->sortable(),
            Switcher::make('Featured', 'is_featured'),
            Switcher::make('Published', 'is_published'),

        ];
    }

    protected function formFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('Имя', 'name')->required(),
            Text::make('Город', 'city'),
            Text::make('Заголовок', 'title'),
            Textarea::make('Текст', 'text')->required(),
            Number::make('Оценка', 'rating')->min(1)->max(5)->default(5),
            Image::make('Аватар', 'avatar')
                ->disk(config('filesystems.media'))
                ->dir('reviews'),

            BelongsTo::make('Устройство', 'device', fn($item) => $item->type ?? ''),
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name ?? ''),
            BelongsTo::make('Услуга', 'service', fn($item) => $item->name ?? ''),

            Switcher::make('Избранный', 'is_featured')->default(false),
            Switcher::make('Опубликован', 'is_published')->default(true),
        ];
    }


    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Имя', 'name'),
            Text::make('Город', 'city'),
            Text::make('Заголовок', 'title'),
            Textarea::make('Текст', 'text'),
            Number::make('Оценка', 'rating'),
            Image::make('Аватар', 'avatar')
                ->disk(config('filesystems.media'))
                ->dir('reviews'),
            Text::make('Устройство', 'device.type'),
            Text::make('Бренд', 'brand.name'),
            Text::make('Услуга', 'service.name'),
            Switcher::make('Избранный', 'is_featured'),
            Switcher::make('Опубликован', 'is_published'),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ReviewIndexPage::class,
            ReviewFormPage::class,
            ReviewDetailPage::class,
        ];
    }
}
