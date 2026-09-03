<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Certificate;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;
use App\MoonShine\Resources\Certificate\Pages\CertificateIndexPage;
use App\MoonShine\Resources\Certificate\Pages\CertificateFormPage;
use App\MoonShine\Resources\Certificate\Pages\CertificateDetailPage;
use App\MoonShine\Resources\Master\MasterResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Certificate, CertificateIndexPage, CertificateFormPage, CertificateDetailPage>
 */
class CertificateResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = Certificate::class;

    protected string $title = 'Certificates';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('Title', 'title')->sortable(),
            Text::make('Subtitle', 'subtitle')->sortable(),
            Text::make('Description', 'description')->sortable(),
            Image::make('Certificate', 'image')->disk(config('filesystems.media')),
            BelongsTo::make(
                'Master',
                'master',
                fn($item) => $item->name,
                MasterResource::class
            )
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->readonly(),
                BelongsTo::make(
                    'Master',
                    'master',
                    fn($item) => $item->name,
                    MasterResource::class
                )
                    ->searchable()
                    ->required(),
                Text::make('Title', 'title')->sortable(),
                Text::make('Subtitle', 'subtitle')->sortable(),
                Text::make('Description', 'description')->sortable(),
                Image::make('Certificate', 'image')
                    ->disk(config('filesystems.media'))
                    ->dir('masters/certificates'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('Title', 'title')->sortable(),
            BelongsTo::make('Master', 'master', MasterResource::class),
            Text::make('Subtitle', 'subtitle')->sortable(),
            Text::make('Description', 'description')->sortable(),
            Image::make('Certificate', 'image')->disk(config('filesystems.media')),
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
            Text::make('Title', 'title'),
            Text::make('Subtitle', 'subtitle'),
            Text::make('Description', 'description'),
            BelongsTo::make('Master', 'master', fn($item) => $item->name, MasterResource::class)
                ->modifyRawValue(fn($raw, $original) => $original?->master?->name),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            CertificateIndexPage::class,
            CertificateFormPage::class,
            CertificateDetailPage::class,
        ];
    }
}
