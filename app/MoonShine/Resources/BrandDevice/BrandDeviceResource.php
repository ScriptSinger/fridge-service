<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\BrandDevice;

use App\Models\BrandDevice;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\BrandDevice\Pages\BrandDeviceDetailPage;
use App\MoonShine\Resources\BrandDevice\Pages\BrandDeviceFormPage;
use App\MoonShine\Resources\BrandDevice\Pages\BrandDeviceIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use Leeto\InputExtensionCharCount\InputExtensions\CharCount;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<BrandDevice, BrandDeviceIndexPage, BrandDeviceFormPage, BrandDeviceDetailPage>
 */
class BrandDeviceResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = BrandDevice::class;

    protected string $title = 'Device Brands';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->sortable(),
            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            )->sortable(),
            Text::make('H1', 'h1'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Title', 'title'),
            Text::make('Description', 'description'),
        ];
    }

    protected function formFields(): iterable
    {
        $brandSuffixLen = mb_strlen(' | ' . config('app.name'));
        $titleMax = max(0, 65 - $brandSuffixLen);
        $titleHint = "55–60 (макс 65). Бренд добавится автоматически (+{$brandSuffixLen} симв.), лимит для ввода: {$titleMax}";

        return [
            Box::make('Заголовки', [
                Text::make('H1', 'h1')
                    ->extension(new CharCount())
                    ->hint('30–60 символов'),
                Text::make('Subtitle', 'subtitle')
                    ->extension(new CharCount())
                    ->hint('105–120 символов'),
            ]),
            Box::make('SEO / Метаданные', [
                Text::make('Title', 'title')
                    ->extension(new CharCount())
                    ->hint($titleHint),
                Text::make('Description', 'description')
                    ->extension(new CharCount())
                    ->hint('140–160 символов'),
            ]),
            Box::make('Связи', [
                BelongsTo::make(
                    'Device',
                    'device',
                    fn($item) => $item->type,
                    DeviceResource::class
                )->searchable()
                    ->required(),
                BelongsTo::make(
                    'Brand',
                    'brand',
                    fn($item) => $item->name,
                    BrandResource::class
                )->searchable()
                    ->required(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            ),
            BelongsTo::make(
                'Brand',
                'brand',
                fn($item) => $item->name,
                BrandResource::class
            ),
            Text::make('H1', 'h1'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Title', 'title'),
            Textarea::make('Description', 'description'),
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
            BelongsTo::make('Device', 'device', fn($item) => $item->type, DeviceResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->device?->type),
            BelongsTo::make('Brand', 'brand', fn($item) => $item->name, BrandResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->brand?->name),
            Text::make('H1', 'h1'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Title', 'title'),
            Text::make('Description', 'description'),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            BrandDeviceIndexPage::class,
            BrandDeviceFormPage::class,
            BrandDeviceDetailPage::class,
        ];
    }
}
