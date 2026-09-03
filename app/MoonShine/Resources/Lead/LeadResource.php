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
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\DateRange;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Lead, LeadIndexPage, LeadFormPage, LeadDetailPage>
 */
class LeadResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = Lead::class;

    protected string $title = 'Leads';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Date::make('Получено', 'created_at')->format('d.m.Y H:i')->sortable(),
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
            Text::make('Name', 'name'),
            Text::make('Phone', 'phone'),
            Select::make('Leadable Type', 'leadable_type')
                ->options([
                    Device::class => 'Device',
                    Brand::class   => 'Brand',
                    Problem::class => 'Problem',
                    ErrorCode::class => 'ErrorCode',
                    Page::class    => 'Page',
                ])
                ->nullable(),
            Switcher::make('Has Comment', 'has_comment')
                ->onApply(function ($query, $value) {
                    if (! $value) {
                        return $query;
                    }

                    return $query->whereNotNull('comment')->where('comment', '!=', '');
                }),
            Switcher::make('Has Leadable', 'has_leadable')
                ->onApply(function ($query, $value) {
                    if (! $value) {
                        return $query;
                    }

                    return $query->whereNotNull('leadable_type')->whereNotNull('leadable_id');
                }),
            DateRange::make('Created between', 'created_at'),
            Text::make('UTM Source', 'utm_source'),
            Text::make('UTM Medium', 'utm_medium'),
            Text::make('UTM Campaign', 'utm_campaign'),
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
            Date::make('Получено', 'created_at')
                ->format('d.m.Y H:i')
                ->modifyRawValue(fn($raw, $original) => $original?->created_at?->format('d.m.Y H:i')),
            Text::make('Name', 'name'),
            Text::make('Phone', 'phone'),
            Textarea::make('Comment', 'comment'),
            Text::make('Utm_source', 'utm_source'),
            Text::make('Utm_medium', 'utm_medium'),
            Text::make('Utm_campaign', 'utm_campaign'),
            Text::make('Leadable', 'leadable')
                ->modifyRawValue(function ($raw, $original) {
                    $leadable = $original?->leadable;

                    if (! $leadable) {
                        return null;
                    }

                    $label = $leadable->title ?? $leadable->name ?? $leadable->type ?? $leadable->getKey();

                    return class_basename($leadable) . ': ' . $label;
                }),
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
