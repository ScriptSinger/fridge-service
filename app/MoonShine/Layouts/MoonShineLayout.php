<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\MenuManager\MenuItem;
use MoonShine\MenuManager\MenuGroup;
use App\Enums\LeadStatus;
use App\Models\Lead;
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
use App\MoonShine\Resources\AccessLog\AccessLogResource;
use App\MoonShine\Resources\AuthLog\AuthLogResource;

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
            // Opt-in column resizing (tables with data-resizable). The
            // mtime query busts nginx's week-long cache for static files.
            Css::make('/assets/moonshine/resizable-table.css?v=' . $this->assetVersion('resizable-table.css')),
            Js::make('/assets/moonshine/resizable-table.js?v=' . $this->assetVersion('resizable-table.js')),
        ];
    }

    private function assetVersion(string $file): int|false
    {
        return @filemtime(public_path('assets/moonshine/' . $file));
    }

    /**
     * Иконки на всех пунктах (не только группах) — так группы и одиночные
     * пункты выглядят одинаково. Паттерн подсмотрен в ~/app/start-stop-laravel.
     */
    protected function menu(): array
    {
        $newLeads = Lead::query()->where('status', LeadStatus::New->value)->count();

        return [
            ...parent::menu(),
            MenuGroup::make('Logs', [
                MenuItem::make(AccessLogResource::class, 'Access Logs')->icon('globe-alt'),
                MenuItem::make(AuthLogResource::class, 'Auth Logs')->icon('shield-check'),
            ], 'archive-box'),
            MenuGroup::make('Content', [
                MenuItem::make(PageResource::class, 'Pages')->icon('document-text'),
                MenuItem::make(PageTypeResource::class, 'PageTypes')->icon('rectangle-stack'),
                MenuItem::make(FaqResource::class, 'Faqs')->icon('question-mark-circle'),
                MenuItem::make(ReviewResource::class, 'Reviews')->icon('star'),
                MenuItem::make(GalleryResource::class, 'Galleries')->icon('photo'),
            ], 'globe-alt'),
            MenuGroup::make('Catalog', [
                MenuItem::make(DeviceResource::class, 'Devices')->icon('cube'),
                MenuItem::make(BrandResource::class, 'Brands')->icon('tag'),
                MenuItem::make(BrandDeviceResource::class, 'Device Brands')->icon('link'),
                MenuItem::make(ProblemResource::class, 'Problems')->icon('exclamation-triangle'),
                MenuItem::make(ServiceResource::class, 'Services')->icon('wrench-screwdriver'),
                MenuItem::make(PriceResource::class, 'Prices')->icon('banknotes'),
                MenuItem::make(ErrorCodeResource::class, 'ErrorCodes')->icon('code-bracket'),
            ], 'squares-2x2'),
            MenuGroup::make('Team', [
                MenuItem::make(MasterResource::class, 'Masters')->icon('identification'),
                MenuItem::make(CertificateResource::class, 'Certificates')->icon('academic-cap'),
            ], 'user-group'),
            MenuGroup::make('Leads', [
                // Видно сразу, сколько новых лидов, без захода в раздел.
                // Только когда > 0 — пустой badge MoonShine передаёт кнопке
                // как false и ломает рендер (см. feedback в start-stop-laravel).
                MenuItem::make(LeadResource::class, 'Leads')->icon('chat-bubble-left-right')
                    ->when($newLeads > 0, fn (MenuItem $item): MenuItem => $item->badge($newLeads)),
            ], 'inbox'),
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
