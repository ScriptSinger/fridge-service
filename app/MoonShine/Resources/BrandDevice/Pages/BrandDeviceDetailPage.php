<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\BrandDevice\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use App\MoonShine\Resources\BrandDevice\BrandDeviceResource;
use MoonShine\Support\ListOf;
use Throwable;

/**
 * @extends DetailPage<BrandDeviceResource>
 */
class BrandDeviceDetailPage extends DetailPage
{
    protected function buttons(): ListOf
    {
        return parent::buttons();
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
