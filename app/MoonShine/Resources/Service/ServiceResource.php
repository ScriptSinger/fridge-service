<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service;

use App\Models\Service;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Price\PriceResource;
use App\MoonShine\Resources\Service\Pages\ServiceIndexPage;
use App\MoonShine\Resources\Service\Pages\ServiceFormPage;
use App\MoonShine\Resources\Service\Pages\ServiceDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\TinyMce\Fields\TinyMce;
use Leeto\InputExtensionCharCount\InputExtensions\CharCount;

/**
 * @extends ModelResource<Service, ServiceIndexPage, ServiceFormPage, ServiceDetailPage>
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Services';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Text::make('Name', 'name')->sortable(),
            Text::make('Description', 'description'),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->sortable(),

            Switcher::make('Активна', 'is_active'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('SEO и заголовки', [
                Text::make('Название услуги', 'name')->required(),
                Text::make('H1', 'h1')
                    ->hint('Например: Замена компрессора холодильника в Уфе'),
                Text::make('SEO title', 'seo_title')
                    ->extension(new CharCount(60))
                    ->hint('До 60 символов без названия компании'),
                Textarea::make('SEO description', 'seo_description')
                    ->hint('Краткое описание для сниппета'),
                Text::make('Подзаголовок', 'subtitle')
                    ->extension(new CharCount(140)),
            ]),
            Box::make('Услуга', [
                Text::make('Slug', 'slug')
                    ->readonly()
                    ->hint('Перегенерируется автоматически при изменении названия'),
                Textarea::make('Краткое описание', 'description')
                    ->hint('Показывается в мобильном прайсе и используется, если не заполнен подзаголовок.'),
                BelongsTo::make(
                    'Техника',
                    'device',
                    fn($item) => $item->type,
                    DeviceResource::class
                )->required()->searchable(),
                HasMany::make('Цены', 'prices')->creatable(),
                Switcher::make('Активна', 'is_active'),
            ]),
            Box::make('Контент посадочной страницы', [
                TinyMce::make('Основной контент', 'content')
                    ->hint('Используйте «Заголовок 2» для разделов и маркированные/нумерованные списки для перечислений. Не вставляйте текст одной строкой.'),
            ]),

        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Name', 'name')->required(),
            Text::make('H1', 'h1'),
            Text::make('SEO title', 'seo_title'),
            Textarea::make('SEO description', 'seo_description'),
            Text::make('Подзаголовок', 'subtitle'),
            Textarea::make('Description', 'description'),
            TinyMce::make('Основной контент', 'content'),
            BelongsTo::make(
                'Device',
                'device',
                fn($item) => $item->type,
                DeviceResource::class
            )->required(),
            HasMany::make('Prices', 'prices'),
            Switcher::make('Активна', 'is_active')

        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ServiceIndexPage::class,
            ServiceFormPage::class,
            ServiceDetailPage::class,
        ];
    }
}
