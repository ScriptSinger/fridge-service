<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function show(Device $device, string $service)
    {
        $ttl = now()->addMinutes(20);

        $service = Cache::remember(
            "service:device:{$device->id}:{$service}",
            $ttl,
            fn () => Service::query()
                ->where('device_id', $device->id)
                ->where('slug', $service)
                ->where('is_active', true)
                ->with('prices.brands')
                ->firstOrFail()
        );

        $galleries = Cache::remember(
            "gallery:service:{$service->id}",
            $ttl,
            fn () => Gallery::query()
                ->where('service_id', $service->id)
                ->orderBy('sort_order')
                ->get()
        );

        $faqs = Cache::remember(
            "faqs:device:{$device->id}",
            $ttl,
            fn () => Faq::query()
                ->where('device_id', $device->id)
                ->whereNull('brand_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
        );

        $relatedServices = Cache::remember(
            "service:device:{$device->id}:related:{$service->id}",
            $ttl,
            fn () => $device->services()
                ->whereKeyNot($service->id)
                ->orderBy('name')
                ->limit(6)
                ->get()
        );

        return view('pages.service', compact('device', 'service', 'galleries', 'faqs', 'relatedServices'));
    }
}
