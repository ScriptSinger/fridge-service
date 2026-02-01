<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Brand;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\MoonShine\Resources\Brand\Pages\BrandIndexPage;
use App\MoonShine\Resources\Brand\Pages\BrandFormPage;
use App\MoonShine\Resources\Brand\Pages\BrandDetailPage;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\ErrorCode\ErrorCodeResource;
use App\MoonShine\Resources\Problem\ProblemResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Brand, BrandIndexPage, BrandFormPage, BrandDetailPage>
 */
class BrandResource extends ModelResource
{
    protected string $model = Brand::class;
    protected string $title = 'Brands';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Text::make('Name', 'name'),
            Text::make('Slug', 'slug'),
            Switcher::make('Активна', 'is_active'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('Slug', 'slug')
                    ->readonly()
                    ->hint('Генерируется автоматически'),
                Text::make('Name', 'name')
                    ->required(),
                Switcher::make('Активна', 'is_active')
                    ->default(true),
            ]),

            Box::make([
                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->dir('services')
                    ->hint('420x260')
                    ->removable(),
                Text::make('Alt для изображения', 'image_alt'),
            ]),

            Box::make([HasMany::make('Error Codes', 'errorCodes', ErrorCodeResource::class),]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Name', 'name'),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Text::make('Alt для изображения', 'image_alt'),
            Switcher::make('Активна', 'is_active'),
            HasMany::make(
                'Problems',
                'problems',
                ProblemResource::class
            )->readonly(),
            HasMany::make(
                'Error Codes',
                'errorCodes',
                ErrorCodeResource::class
            )->readonly(),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            BrandIndexPage::class,
            BrandFormPage::class,
            BrandDetailPage::class,
        ];
    }
}
