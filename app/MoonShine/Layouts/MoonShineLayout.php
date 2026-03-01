<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Certificate\CertificateResource;
use App\MoonShine\Resources\ErrorCode\ErrorCodeResource;
use App\MoonShine\Resources\Lead\LeadResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Problem\ProblemResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Faq\FaqResource;
use App\MoonShine\Resources\Price\PriceResource;
use App\MoonShine\Resources\Gallery\GalleryResource;
use App\MoonShine\Resources\Master\MasterResource;
use App\MoonShine\Resources\PageType\PageTypeResource;
use App\MoonShine\Resources\Review\ReviewResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuItem::make(PageResource::class, 'Pages'),
            MenuItem::make(PageTypeResource::class, 'PageTypes'),
            MenuItem::make(DeviceResource::class, 'Devices'),
            MenuItem::make(ProblemResource::class, 'Problems'),
            MenuItem::make(BrandResource::class, 'Brands'),
            MenuItem::make(ErrorCodeResource::class, 'ErrorCodes'),
            MenuItem::make(LeadResource::class, 'Leads'),
            MenuItem::make(ServiceResource::class, 'Services'),
            MenuItem::make(PriceResource::class, 'Prices'),
            MenuItem::make(FaqResource::class, 'Faqs'),

            MenuItem::make(GalleryResource::class, 'Galleries'),
            MenuItem::make(ReviewResource::class, 'Reviews'),
            MenuItem::make(MasterResource::class, 'Masters'),
            MenuItem::make(CertificateResource::class, 'Certitficates'),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}
