<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Faq;

use Illuminate\Database\Eloquent\Model;
use App\Models\Faq;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Faq\Pages\FaqIndexPage;
use App\MoonShine\Resources\Faq\Pages\FaqFormPage;
use App\MoonShine\Resources\Faq\Pages\FaqDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
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
class FaqResource extends ModelResource
{
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
            BelongsTo::make('Тип техники', 'device', fn($item) => $item->type, DeviceResource::class),
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class),
            BelongsTo::make('Страница', 'page', fn($item) => $item->type, PageResource::class),
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
                    ->searchable(),
                BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class)
                    ->nullable()
                    ->searchable(),
                BelongsTo::make('Страница', 'page', fn($item) => $item->type, PageResource::class)
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
            BelongsTo::make('Бренд', 'brand', fn($item) => $item->name, BrandResource::class),
            BelongsTo::make('Страница', 'page', fn($item) => $item->type, PageResource::class),
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
