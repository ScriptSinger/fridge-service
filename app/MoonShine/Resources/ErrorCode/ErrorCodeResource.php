<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ErrorCode;

use Illuminate\Database\Eloquent\Model;
use App\Models\ErrorCode;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\ErrorCode\Pages\ErrorCodeIndexPage;
use App\MoonShine\Resources\ErrorCode\Pages\ErrorCodeFormPage;
use App\MoonShine\Resources\ErrorCode\Pages\ErrorCodeDetailPage;
use App\MoonShine\Resources\Problem\ProblemResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<ErrorCode, ErrorCodeIndexPage, ErrorCodeFormPage, ErrorCodeDetailPage>
 */
class ErrorCodeResource extends ModelResource
{
    protected string $model = ErrorCode::class;

    protected string $title = 'ErrorCodes';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Title', 'code'),
            Text::make('Code', 'code'),
            Textarea::make('Description', 'description'),
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

                Text::make('Title', 'title')
                    ->required(),

                Text::make('Code', 'code')
                    ->required(),

                Textarea::make('Description', 'description'),

                BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)
                    ->required()
                    ->searchable(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Title', 'code'),
            Text::make('Code', 'code'),
            Textarea::make('Description', 'description'),

            HasMany::make(
                'Problems',
                'problems',
                ProblemResource::class
            )->readonly(),

            HasMany::make(
                'Brand',
                'brand',
                BrandResource::class
            )->readonly(),
        ];
    }


    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ErrorCodeIndexPage::class,
            ErrorCodeFormPage::class,
            ErrorCodeDetailPage::class,
        ];
    }
}
