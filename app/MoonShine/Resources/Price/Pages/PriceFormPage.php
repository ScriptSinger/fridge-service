<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Price\Pages;

use App\Models\BrandDevice;
use App\Models\Service;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Price\PriceResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<PriceResource>
 */
class PriceFormPage extends FormPage
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
            'service_id' => ['required', 'exists:services,id'],
            'device_id' => [
                'nullable',
                'exists:devices,id',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $serviceId = request()->integer('service_id');

                    if (! $serviceId || ! $value) {
                        return;
                    }

                    $service = Service::query()->find($serviceId);

                    if ($service && $service->device_id !== (int) $value) {
                        $fail('У выбранной услуги другое устройство. Цена должна ссылаться на устройство услуги.');
                    }
                },
            ],
            'brands' => [
                'nullable',
                'array',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (empty($value)) {
                        return;
                    }

                    $deviceId = request()->integer('device_id');

                    if (! $deviceId) {
                        $fail('Для брендовой цены нужно указать устройство.');

                        return;
                    }

                    foreach ((array) $value as $brandId) {
                        $exists = BrandDevice::query()
                            ->where('device_id', $deviceId)
                            ->where('brand_id', (int) $brandId)
                            ->exists();

                        if (! $exists) {
                            $fail('Среди выбранных брендов есть бренд, не привязанный к указанному устройству.');

                            return;
                        }
                    }
                },
            ],
            'brands.*' => ['integer', 'exists:brands,id'],
            'price_from' => ['nullable', 'integer', 'min:0'],
            'price_to' => ['nullable', 'integer', 'min:0', 'gte:price_from'],
            'units' => ['nullable', 'string', 'max:8'],
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
