<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\ErrorCode\ErrorCodeResource;
use App\MoonShine\Resources\Lead\LeadResource;
use App\MoonShine\Resources\Problem\ProblemResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Device\DeviceResource;
use App\MoonShine\Resources\Price\PriceResource;
use App\MoonShine\Resources\Faq\FaqResource;
use App\MoonShine\Resources\Gallery\GalleryResource;
use App\MoonShine\Resources\PageType\PageTypeResource;
use App\MoonShine\Resources\Review\ReviewResource;
use App\MoonShine\Resources\Master\MasterResource;
use App\MoonShine\Resources\Certificate\CertificateResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  CoreContract<MoonShineConfigurator>  $core
     */
    public function boot(CoreContract $core): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ServiceResource::class,
                BrandResource::class,
                ErrorCodeResource::class,
                LeadResource::class,
                ProblemResource::class,
                PageResource::class,
                DeviceResource::class,
                PriceResource::class,
                FaqResource::class,
                GalleryResource::class,
                PageTypeResource::class,
                ReviewResource::class,
                MasterResource::class,
                CertificateResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
            ])
        ;
    }
}
