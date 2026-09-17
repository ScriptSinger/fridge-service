<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Faq;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Problem;
use App\Models\Service;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\ErrorCode\ErrorCodeResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Problem\ProblemResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Faq\Pages\FaqIndexPage;
use App\MoonShine\Resources\Faq\Pages\FaqFormPage;
use App\MoonShine\Resources\Faq\Pages\FaqDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\ExportHandler;
use App\MoonShine\Support\GuardedImportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Faq, FaqIndexPage, FaqFormPage, FaqDetailPage>
 */
class FaqResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = Faq::class;

    protected string $title = 'Faqs';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('Question', 'question')->sortable(),
            Text::make('Answer', 'answer')->sortable(),
            Number::make('Порядок', 'sort_order')->sortable(),
            Switcher::make('Активна', 'is_active')->sortable(),
            BelongsTo::make('Тип техники', 'device', fn($item) => $item->type, DeviceResource::class)->sortable(),
            BelongsTo::make('Услуга', 'service', fn($item) => $item->name, ServiceResource::class)->sortable(),
            BelongsTo::make('Неисправность', 'problem', fn($item) => trim(($item->device?->type ? $item->device->type.' — ' : '').$item->title), ProblemResource::class)->sortable(),
            BelongsTo::make('Код ошибки', 'errorCode', fn($item) => trim(($item->brand?->name ? $item->brand->name.' — ' : '').($item->code ?: $item->title)), ErrorCodeResource::class)->sortable(),
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class)->sortable(),
            BelongsTo::make('Страница', 'page', fn($item) => $item->h1, PageResource::class)->sortable(),
        ];
    }

    protected function filters(): iterable
    {
        return [
            BelongsTo::make('Тип техники', 'device', fn($item) => $item->type, DeviceResource::class)
                ->nullable()
                ->searchable(),
            BelongsTo::make('Услуга', 'service', fn($item) => $item->name, ServiceResource::class)
                ->nullable()
                ->searchable(),
            BelongsTo::make('Неисправность', 'problem', fn($item) => trim(($item->device?->type ? $item->device->type.' — ' : '').$item->title), ProblemResource::class)
                ->nullable()
                ->searchable(),
            BelongsTo::make('Код ошибки', 'errorCode', fn($item) => trim(($item->brand?->name ? $item->brand->name.' — ' : '').($item->code ?: $item->title)), ErrorCodeResource::class)
                ->nullable()
                ->searchable(),
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class)
                ->nullable()
                ->searchable(),
            BelongsTo::make('Страница', 'page', fn($item) => $item->h1, PageResource::class)
                ->nullable()
                ->searchable(),
            Switcher::make('Активна', 'is_active'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->readonly(),
                Text::make('Question', 'question'),
                Textarea::make('Answer', 'answer'),
                Number::make('Порядок', 'sort_order'),
                Switcher::make('Активна', 'is_active'),
                BelongsTo::make('Тип техники', 'device', fn($item) => $item->type, DeviceResource::class)
                    ->nullable()
                    ->searchable()
                    ->hint('Общий FAQ устройства (показывается на страницах услуг без своего FAQ).'),
                BelongsTo::make('Услуга', 'service', fn($item) => $item->name, ServiceResource::class)
                    ->nullable()
                    ->searchable()
                    ->hint('Если указано — вопрос показывается только на странице этой услуги, а не на всех услугах устройства.'),
                BelongsTo::make('Неисправность', 'problem', fn($item) => trim(($item->device?->type ? $item->device->type.' — ' : '').$item->title), ProblemResource::class)
                    ->nullable()
                    ->searchable()
                    ->hint('Если указано — вопрос показывается только на странице этой неисправности.'),
                BelongsTo::make('Код ошибки', 'errorCode', fn($item) => trim(($item->brand?->name ? $item->brand->name.' — ' : '').($item->code ?: $item->title)), ErrorCodeResource::class)
                    ->nullable()
                    ->searchable()
                    ->hint('Если указано — вопрос показывается только на странице этого кода ошибки.'),
                BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class)
                    ->nullable()
                    ->searchable(),
                BelongsTo::make('Страница', 'page', fn($item) => $item->h1, PageResource::class)
                    ->nullable()
                    ->searchable(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('Question', 'question')->sortable(),
            Text::make('Answer', 'answer')->sortable(),
            Number::make('Порядок', 'sort_order')->sortable(),
            Switcher::make('Активна', 'is_active')->sortable(),
            BelongsTo::make('Тип техники', 'device', fn($item) => $item->type, DeviceResource::class),
            BelongsTo::make('Услуга', 'service', fn($item) => $item->name, ServiceResource::class),
            BelongsTo::make('Неисправность', 'problem', fn($item) => trim(($item->device?->type ? $item->device->type.' — ' : '').$item->title), ProblemResource::class),
            BelongsTo::make('Код ошибки', 'errorCode', fn($item) => trim(($item->brand?->name ? $item->brand->name.' — ' : '').($item->code ?: $item->title)), ErrorCodeResource::class),
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class),
            BelongsTo::make('Страница', 'page', fn($item) => $item->h1, PageResource::class),
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
        return GuardedImportHandler::make('Импорт из CSV')
            ->delimiter(';');
    }

    /**
     * @return list<FieldContract>
     */
    protected function exportFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Question', 'question'),
            Text::make('Answer', 'answer'),
            Number::make('Порядок', 'sort_order'),
            Switcher::make('Активна', 'is_active'),
            BelongsTo::make('Тип техники', 'device', fn($item) => $item->type, DeviceResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->device?->type),
            BelongsTo::make('Услуга', 'service', fn($item) => $item->name, ServiceResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->service?->name),
            BelongsTo::make('Неисправность', 'problem', fn($item) => trim(($item->device?->type ? $item->device->type.' — ' : '').$item->title), ProblemResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->problem?->slug),
            BelongsTo::make('Код ошибки', 'errorCode', fn($item) => trim(($item->brand?->name ? $item->brand->name.' — ' : '').($item->code ?: $item->title)), ErrorCodeResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->errorCode?->slug),
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->brand?->name),
            BelongsTo::make('Страница', 'page', fn($item) => $item->h1, PageResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->page?->h1),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function importFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Question', 'question'),
            Text::make('Answer', 'answer'),
            Number::make('Порядок', 'sort_order')->default(0),
            Switcher::make('Активна', 'is_active')->default(false),
            Text::make('Тип техники', 'device_id')
                ->nullable()
                ->fromRaw(fn($raw) => filled($raw) ? Device::query()->where('type', $raw)->value('id') : null),
            Text::make('Услуга', 'service_id')
                ->nullable()
                ->fromRaw(fn($raw) => filled($raw) ? Service::query()->where('name', $raw)->value('id') : null),
            Text::make('Неисправность', 'problem_id')
                ->nullable()
                ->hint('Слаг неисправности (не заголовок — заголовки повторяются у разных устройств).')
                ->fromRaw(fn($raw) => filled($raw) ? Problem::query()->where('slug', $raw)->value('id') : null),
            Text::make('Код ошибки', 'error_code_id')
                ->nullable()
                ->hint('Слаг кода ошибки (не сам код — коды вроде E15 повторяются у разных брендов).')
                ->fromRaw(fn($raw) => filled($raw) ? ErrorCode::query()->where('slug', $raw)->value('id') : null),
            Text::make('Бренд', 'brand_id')
                ->nullable()
                ->fromRaw(fn($raw) => filled($raw) ? Brand::query()->where('name', $raw)->value('id') : null),
            Text::make('Страница', 'page_id')
                ->nullable()
                ->fromRaw(fn($raw) => filled($raw) ? Page::query()->where('h1', $raw)->value('id') : null),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            FaqIndexPage::class,
            FaqFormPage::class,
            FaqDetailPage::class,
        ];
    }
}
