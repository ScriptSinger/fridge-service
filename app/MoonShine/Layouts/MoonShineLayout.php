<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\MenuManager\MenuItem;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\BrandDevice\BrandDeviceResource;
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
use App\MoonShine\Pages\AccessLogs;

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
            MenuGroup::make('Content', [
                MenuItem::make(PageResource::class, 'Pages'),
                MenuItem::make(PageTypeResource::class, 'PageTypes'),
                MenuItem::make(FaqResource::class, 'Faqs'),
                MenuItem::make(ReviewResource::class, 'Reviews'),
                MenuItem::make(GalleryResource::class, 'Galleries'),
            ]),
            MenuGroup::make('Catalog', [
                MenuItem::make(DeviceResource::class, 'Devices'),
                MenuItem::make(BrandResource::class, 'Brands'),
                MenuItem::make(BrandDeviceResource::class, 'Device Brands'),
                MenuItem::make(ProblemResource::class, 'Problems'),
                MenuItem::make(ServiceResource::class, 'Services'),
                MenuItem::make(PriceResource::class, 'Prices'),
                MenuItem::make(ErrorCodeResource::class, 'ErrorCodes'),
            ]),
            MenuGroup::make('Team', [
                MenuItem::make(MasterResource::class, 'Masters'),
                MenuItem::make(CertificateResource::class, 'Certificates'),
            ]),
            MenuGroup::make('Leads', [
                MenuItem::make(LeadResource::class, 'Leads'),
            ]),
            MenuItem::make(AccessLogs::class, 'Access Logs'),
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
