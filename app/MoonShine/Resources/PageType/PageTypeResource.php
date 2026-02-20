<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PageType;

use Illuminate\Database\Eloquent\Model;
use App\Models\PageType;
use App\MoonShine\Resources\PageType\Pages\PageTypeIndexPage;
use App\MoonShine\Resources\PageType\Pages\PageTypeFormPage;
use App\MoonShine\Resources\PageType\Pages\PageTypeDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<PageType, PageTypeIndexPage, PageTypeFormPage, PageTypeDetailPage>
 */
class PageTypeResource extends ModelResource
{
    protected string $model = PageType::class;

    protected string $title = 'PageTypes';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Key', 'key'),
            Text::make('Name', 'name'),
            Text::make('Template', 'template'),
            Switcher::make('Системная', 'is_system')
        ];
    }

    protected function formFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Key', 'key'),
            Text::make('Name', 'name'),
            Text::make('Template', 'template'),
            Switcher::make('Системная', 'is_system')
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Key', 'key'),
            Text::make('Name', 'name'),
            Text::make('Template', 'template'),
            Switcher::make('Системная', 'is_system')
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            PageTypeIndexPage::class,
            PageTypeFormPage::class,
            PageTypeDetailPage::class,
        ];
    }
}
