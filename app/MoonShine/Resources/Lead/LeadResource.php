<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Lead;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;
use App\MoonShine\Resources\Lead\Pages\LeadIndexPage;
use App\MoonShine\Resources\Lead\Pages\LeadFormPage;
use App\MoonShine\Resources\Lead\Pages\LeadDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Lead, LeadIndexPage, LeadFormPage, LeadDetailPage>
 */
class LeadResource extends ModelResource
{
    protected string $model = Lead::class;

    protected string $title = 'Leads';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Name', 'name'),
            Text::make('Phone', 'phone'),

            Textarea::make('Comment', 'comment'),

            Text::make('Utm_source', 'utm_source'),
            Text::make('Utm_medium', 'utm_medium'),
            Text::make('Utm_campaign', 'utm_campaign'),
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

                Text::make('Name', 'name'),
                Text::make('Phone', 'phone'),

                Textarea::make('Comment', 'comment'),

                Text::make('Utm_source', 'utm_source'),
                Text::make('Utm_medium', 'utm_medium'),
                Text::make('Utm_campaign', 'utm_campaign'),

            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Name', 'name'),
            Textarea::make('Description', 'description'),
        ];
    }


    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            LeadIndexPage::class,
            LeadFormPage::class,
            LeadDetailPage::class,
        ];
    }
}
