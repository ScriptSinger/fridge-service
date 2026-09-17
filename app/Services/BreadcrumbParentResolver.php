<?php

namespace App\Services;

use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Gallery;
use App\Models\Problem;

/**
 * Decides which page a breadcrumb trail should parent through, for pages
 * whose "real" parent depends on data (brand-specific vs. general-device)
 * rather than on the URL alone. Kept free of the BreadcrumbTrail/route()
 * globals so the branching rules can be unit tested directly.
 */
final class BreadcrumbParentResolver
{
    /**
     * A Problem parents through its first active brand's page when it's
     * brand-specific, otherwise through the plain device page.
     * See memory: problem-brand-vs-device.
     */
    public function forProblem(Problem $problem, Device $device): BreadcrumbTarget
    {
        $brand = $problem->brands->first();

        return $brand
            ? new BreadcrumbTarget('devices.brands.show', [$brand])
            : new BreadcrumbTarget('devices.show', [$device]);
    }

    /**
     * Same brand-specific vs. general-device rule as forProblem(), but
     * ErrorCode stores its brand as a direct belongsTo rather than a
     * many-to-many, so there's no "first of many" to pick.
     */
    public function forErrorCode(ErrorCode $errorCode, Device $device): BreadcrumbTarget
    {
        return $errorCode->brand
            ? new BreadcrumbTarget('devices.brands.show', [$errorCode->brand])
            : new BreadcrumbTarget('devices.show', [$device]);
    }

    /**
     * Gallery items are only ever reached via Device/Service/Brand pages
     * (never Problem/ErrorCode, even though those relations may be set on
     * the record) — see memory: gallery-breadcrumb-parents. Priority:
     * brand > service > bare device > gallery index.
     */
    public function forGallery(Gallery $gallery): BreadcrumbTarget
    {
        if ($gallery->brand && $gallery->device) {
            return new BreadcrumbTarget(
                parentRoute: 'devices.show',
                parentParams: [$gallery->device],
                extraLabel: $gallery->brand->name,
                extraRoute: 'devices.brands.show',
                extraParams: [$gallery->device, $gallery->brand],
            );
        }

        if ($gallery->service && $gallery->service->device) {
            return new BreadcrumbTarget(
                parentRoute: 'devices.show',
                parentParams: [$gallery->service->device],
                extraLabel: $gallery->service->name,
                extraRoute: 'services.show',
                extraParams: [$gallery->service->device, $gallery->service->slug],
            );
        }

        if ($gallery->device) {
            return new BreadcrumbTarget('devices.show', [$gallery->device]);
        }

        return new BreadcrumbTarget('gallery.index');
    }
}
