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
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Certificate, CertificateIndexPage, CertificateFormPage, CertificateDetailPage>
 */
class CertificateResource extends ModelResource
{
    protected string $model = Certificate::class;

    protected string $title = 'Certificates';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->readonly(),
            BelongsTo::make('Master', 'master', MasterResource::class),
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
