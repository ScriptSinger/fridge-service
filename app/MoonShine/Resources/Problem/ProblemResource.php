<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Problem;

use Illuminate\Database\Eloquent\Model;
use App\Models\Problem;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\ErrorCode\ErrorCodeResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Support\TinyMceUpload;
use App\MoonShine\Resources\Problem\Pages\ProblemIndexPage;
use App\MoonShine\Resources\Problem\Pages\ProblemFormPage;
use App\MoonShine\Resources\Problem\Pages\ProblemDetailPage;

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
 * @extends ModelResource<Problem, ProblemIndexPage, ProblemFormPage, ProblemDetailPage>
 */
class ProblemResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = Problem::class;

    protected string $title = 'Problems';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Text::make('Title', 'title')->sortable(),
            Text::make('H1', 'h1')->sortable(),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->sortable(),
            Text::make('Content', 'short_content'),
            Switcher::make('Активна', 'is_active')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Заголовки', [
                Text::make('Title', 'title')
                    ->required()
                    ->extension(new CharCount(255))
                    ->hint('Короткое название — используется в карточках, хлебных крошках и ссылках.'),

                Text::make('H1', 'h1')
                    ->required()
                    ->extension(new CharCount(255))
                    ->hint('Полный заголовок страницы неисправности, например: «Холодильник не включается: причины и ремонт в Уфе».'),

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

            Box::make('Неисправность', [
                ID::make()->readonly(),

                Text::make('Slug', 'slug')
                    ->readonly()
                    ->hint('Генерируется автоматически'),

                BelongsTo::make(
                    'Device',
                    'device',
                    fn($item) => $item->type,
                    DeviceResource::class
                )
                    ->required()
                    ->searchable(),

                Switcher::make('Активна', 'is_active'),
            ]),

            Box::make('Контент', [
                TinyMceUpload::withImageUpload(
                    TinyMce::make('Основной контент', 'content')
                        ->hint('Используйте «Заголовок 2» для разделов и маркированные/нумерованные списки для перечислений: причины, признаки, стоимость ремонта.')
                ),
            ]),

            Box::make('Связи', [
                BelongsToMany::make(
                    'Brands',
                    'brands',
                    fn($item) => $item->name,
                    BrandResource::class
                ),

                BelongsToMany::make(
                    'Error Codes',
                    'errorCodes',
                    fn($item) => $item->title,
                    ErrorCodeResource::class
                ),

                BelongsToMany::make(
                    'Услуги',
                    'services',
                    fn($item) => $item->name,
                    ServiceResource::class
                )->valuesQuery(fn ($query) => $query->when(
                    $this->getItem()?->device_id,
                    fn ($q, $deviceId) => $q->where('device_id', $deviceId)
                )),
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
            TinyMce::make('Основной контент', 'content'),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->readonly(),

            BelongsToMany::make(
                'Brands',
                'brands',
                BrandResource::class
            )->readonly(),

            BelongsToMany::make(
                'Error Codes',
                'errorCodes',
                ErrorCodeResource::class
            )->readonly(),

            BelongsToMany::make(
                'Услуги',
                'services',
                ServiceResource::class
            )->readonly(),

            Switcher::make('Активна', 'is_active'),

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
            Switcher::make('Активна', 'is_active'),
            BelongsTo::make('Device', 'device', fn($item) => $item->type, DeviceResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->device?->type),
            Text::make('Brands', 'brands')
                ->modifyRawValue(fn($raw, $original) => $original?->brands?->pluck('name')->implode(', ')),
            Text::make('Error Codes', 'errorCodes')
                ->modifyRawValue(fn($raw, $original) => $original?->errorCodes?->pluck('title')->implode(', ')),
            Text::make('Услуги', 'services')
                ->modifyRawValue(fn($raw, $original) => $original?->services?->pluck('name')->implode(', ')),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProblemIndexPage::class,
            ProblemFormPage::class,
            ProblemDetailPage::class,
        ];
    }
}
