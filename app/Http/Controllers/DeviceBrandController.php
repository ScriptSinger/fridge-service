<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class DeviceBrandController extends Controller
{
    private const GALLERY_MIN = 6;

    public function show(Device $device, Brand $brand)
    {
        $brand = $device->brands()
            ->whereKey($brand->id)
            ->firstOrFail();

        $ttl = now()->addMinutes(20);
        $problems = Cache::remember("problems:device:{$device->id}:brand:{$brand->id}", $ttl, fn() => $brand->problems()
            ->where('device_id', $device->id)
            ->where('is_active', true)
            ->get());
        // Brands with few or no works of their own would show a near-empty slider,
        // so the row is topped up with other repairs of the same device type.
        $galleries = Cache::remember("gallery:device:{$device->id}:brand:{$brand->id}", $ttl, function () use ($device, $brand) {
            $own = Gallery::query()
                ->hasImage()
                ->where('device_id', $device->id)
                ->where('brand_id', $brand->id)
                ->orderBy('sort_order')
                ->get();

            $missing = self::GALLERY_MIN - $own->count();
            if ($missing <= 0) {
                return $own;
            }

            return $own->concat(Gallery::query()
                ->hasImage()
                ->where('device_id', $device->id)
                ->where(fn ($query) => $query->whereNull('brand_id')->orWhere('brand_id', '!=', $brand->id))
                ->orderBy('sort_order')
                ->limit($missing)
                ->get());
        });
        $brandFaqs = Cache::remember("faqs:device:{$device->id}:brand:{$brand->id}", $ttl, fn() => Faq::query()
            ->where('device_id', $device->id)
            ->where('brand_id', $brand->id)
            ->whereNull('service_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
        $services = Cache::remember("device:{$device->id}:brand:{$brand->id}:services", $ttl, fn() => $device->services()
            ->with('prices.brands')
            ->get()
            ->filter(fn ($service) => $service->prices->contains(
                fn ($price) => $price->appliesToBrand($brand->id)
            ))
            ->values());
        $errorCodes = Cache::remember("errorcodes:device:{$device->id}:brand:{$brand->id}", $ttl, fn() => $brand->errorCodes()
            ->where('device_id', $device->id)
            ->whereNotNull('slug')
            ->where('is_active', true)
            ->orderBy('code')
            ->get());

        return view('pages.brand', [
            'device'   => $device,
            'brand'    => $brand,
            'problems' => $problems,
            'services' => $services,
            'galleries' => $galleries,
            'errorCodes' => $errorCodes,
            'faqs' => $brandFaqs,
            'title' => $brand->pivot->title ?: $device->title,
            'description' => $brand->pivot->description ?: $device->description,
        ]);
    }
}
