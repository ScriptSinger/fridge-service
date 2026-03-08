<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Gallery\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Gallery\GalleryResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<GalleryResource>
 */
class GalleryFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    // protected function fields(): iterable
    // {
    //     return [
    //         Box::make([
    //             ID::make(),
    //         ]),
    //     ];
    // }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['required', 'date'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'device_id' => ['nullable', 'exists:devices,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'page_id' => ['nullable', 'exists:pages,id'],
        ];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
