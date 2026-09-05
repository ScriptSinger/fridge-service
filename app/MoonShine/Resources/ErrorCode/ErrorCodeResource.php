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
use App\MoonShine\Support\TinyMceUpload;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\TinyMce\Fields\TinyMce;
use Leeto\InputExtensionCharCount\InputExtensions\CharCount;

/**
 * @extends ModelResource<ErrorCode, ErrorCodeIndexPage, ErrorCodeFormPage, ErrorCodeDetailPage>
 */
class ErrorCodeResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = ErrorCode::class;

    protected string $title = 'ErrorCodes';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Text::make('Title', 'title')->sortable(),
            Text::make('H1', 'h1')->sortable(),
            Text::make('Code', 'code')->sortable(),
            BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)->nullable()->sortable(),
            Switcher::make('Активен', 'is_active')->sortable(),
        ];
    }

    protected function filters(): iterable
    {
        return [
            BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)
                ->nullable()
                ->searchable(),
            Text::make('Code', 'code'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Заголовки', [
                Text::make('Title', 'title')
                    ->required()
                    ->extension(new CharCount(255))
                    ->hint('Короткое название — используется в бейджах, хлебных крошках и ссылках.'),

                Text::make('H1', 'h1')
                    ->required()
                    ->extension(new CharCount(255))
                    ->hint('Полный заголовок страницы кода ошибки, например: «Ошибка E3 холодильника LG: причины и ремонт в Уфе».'),

                Text::make('Подзаголовок', 'subtitle')
                    ->extension(new CharCount(140)),
            ]),

            Box::make('SEO / Метаданные', [
                Text::make('SEO title', 'seo_title')
                    ->extension(new CharCount(60))
                    ->hint('До 60 символов без названия компании'),

                Textarea::make('SEO description', 'seo_description')
                    ->hint('Краткое описание для сниппета'),
            ]),

            Box::make('Код ошибки', [
                ID::make()->readonly(),

                Text::make('Slug', 'slug')
                    ->readonly()
                    ->hint('Генерируется автоматически'),

                Text::make('Code', 'code')
                    ->required(),

                BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)
                    ->required()
                    ->searchable(),

                Switcher::make('Активен', 'is_active'),
            ]),

            Box::make('Контент', [
                TinyMceUpload::withImageUpload(
                    TinyMce::make('Основной контент', 'content')
                        ->hint('Причины возникновения, что можно проверить самому, когда опасно чинить самостоятельно. Используйте «Заголовок 2» для разделов и списки для перечислений.')
                ),
            ]),

            Box::make('Связи', [
                BelongsToMany::make(
                    'Problems',
                    'problems',
                    fn($item) => $item->title,
                    ProblemResource::class
                ),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Title', 'title'),
            Text::make('H1', 'h1'),
            Text::make('Подзаголовок', 'subtitle'),
            Text::make('SEO title', 'seo_title'),
            Textarea::make('SEO description', 'seo_description'),
            Text::make('Code', 'code'),
            TinyMce::make('Основной контент', 'content'),

            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            )->readonly(),

            BelongsToMany::make(
                'Problems',
                'problems',
                ProblemResource::class
            )->readonly(),

            Switcher::make('Активен', 'is_active'),
        ];
    }


    protected function export(): ?Handler
    {
        return ExportHandler::make('Экспорт в CSV')
            ->csv()
            ->delimiter(';');
    }

    protected function import(): ?Handler
    {
        return null;
    }

    /**
     * @return list<FieldContract>
     */
    protected function exportFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Slug', 'slug'),
            Text::make('Title', 'title'),
            Text::make('H1', 'h1'),
            Text::make('Подзаголовок', 'subtitle'),
            Text::make('SEO title', 'seo_title'),
            Textarea::make('SEO description', 'seo_description'),
            Text::make('Code', 'code'),
            Switcher::make('Активен', 'is_active'),
            BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->brand?->name),
            Text::make('Problems', 'problems')
                ->modifyRawValue(fn($raw, $original) => $original?->problems?->pluck('title')->implode(', ')),
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
