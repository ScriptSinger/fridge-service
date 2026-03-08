<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Review\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Review\ReviewResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<ReviewResource>
 */
class ReviewFormPage extends FormPage
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
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
            'source' => ['nullable', 'in:google,yandex,avito'],
            'device_id' => ['nullable', 'exists:devices,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'published_at' => ['required', 'date'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_published' => ['sometimes', 'boolean'],
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
