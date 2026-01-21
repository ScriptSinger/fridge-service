<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Lead;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Service;
use App\MoonShine\Resources\Lead\Pages\LeadIndexPage;
use App\MoonShine\Resources\Lead\Pages\LeadFormPage;
use App\MoonShine\Resources\Lead\Pages\LeadDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
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
            Text::make('Name', 'name'),
            Text::make('Phone', 'phone'),
            Textarea::make('Comment', 'comment'),

            MorphTo::make('Leadable', 'leadable')
                ->types([
                    Service::class => 'title',
                    Brand::class   => 'name',
                    Page::class => 'title',
                ]),

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
            Text::make('Name', 'name'),
            Text::make('Phone', 'phone'),
            Textarea::make('Comment', 'comment'),
            Text::make('Utm_source', 'utm_source'),
            Text::make('Utm_medium', 'utm_medium'),
            Text::make('Utm_campaign', 'utm_campaign'),
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
