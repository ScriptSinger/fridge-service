<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Lead;

use App\Models\Brand;
use App\Models\Device;
use Illuminate\Database\Eloquent\Model;
use App\Models\ErrorCode;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Problem;
use App\MoonShine\Resources\Lead\Pages\LeadIndexPage;
use App\MoonShine\Resources\Lead\Pages\LeadFormPage;
use App\MoonShine\Resources\Lead\Pages\LeadDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\DateRange;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
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
            Text::make('Name', 'name')->sortable(),
            Text::make('Phone', 'phone')->sortable(),
            Textarea::make('Comment', 'comment')->sortable(),
            MorphTo::make('Leadable', 'leadable')
                ->types([
                    Device::class => 'title',
                    Brand::class => 'name',
                    Problem::class => 'title',
                    ErrorCode::class => 'title',
                    Page::class => 'title',
                ])->sortable(),

            Text::make('Utm_source', 'utm_source')->sortable(),
            Text::make('Utm_medium', 'utm_medium')->sortable(),
            Text::make('Utm_campaign', 'utm_campaign')->sortable(),
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

    protected function filters(): array
    {
        return [
            Select::make('Leadable Type', 'leadable_type')
                ->options([
                    Device::class => 'Device',
                    Brand::class   => 'Brand',
                    Problem::class => 'Problem',
                    ErrorCode::class => 'ErrorCode',
                    Page::class    => 'Page',
                ])
                ->nullable(),
            DateRange::make('Created between', 'created_at'),
            Text::make('UTM Source', 'utm_source'),
            Text::make('UTM Medium', 'utm_medium'),
            Text::make('UTM Campaign', 'utm_campaign'),
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
