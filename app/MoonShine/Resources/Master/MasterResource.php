<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master;
use App\MoonShine\Resources\Master\Pages\MasterIndexPage;
use App\MoonShine\Resources\Master\Pages\MasterFormPage;
use App\MoonShine\Resources\Master\Pages\MasterDetailPage;
use App\MoonShine\Resources\Certificate\CertificateResource;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Master, MasterIndexPage, MasterFormPage, MasterDetailPage>
 */
class MasterResource extends ModelResource
{
    protected string $model = Master::class;

    protected string $title = 'Masters';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('ФИО', 'full_name')->sortable(),
            Text::make('Role', 'role')->sortable(),
            Text::make('Description', 'description')->sortable(),
            Image::make('Photo', 'photo')->disk(config('filesystems.media')),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->readonly(),
                Flex::make([
                    Text::make('Фамилия', 'last_name')->sortable(),
                    Text::make('Имя', 'first_name')->sortable(),
                    Text::make('Отчество', 'middle_name')->sortable(),
                ]),
                Text::make('Role', 'role')->sortable(),
                Image::make('Photo', 'photo')
                    ->disk(config('filesystems.media'))
                    ->dir('masters/avatars'),

                Text::make('Description', 'description')->sortable(),

            ]),
            Box::make([
                HasMany::make('Certificates', 'certificates', CertificateResource::class)
                    ->creatable(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->readonly(),
            Text::make('ФИО', 'full_name')->sortable(),
            Text::make('Role', 'role')->sortable(),
            Text::make('Description', 'description')->sortable(),
            Image::make('Photo', 'photo')->disk(config('filesystems.media')),
            HasMany::make('Certificates', 'certificates', CertificateResource::class)->readonly(),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            MasterIndexPage::class,
            MasterFormPage::class,
            MasterDetailPage::class,
        ];
    }
}
