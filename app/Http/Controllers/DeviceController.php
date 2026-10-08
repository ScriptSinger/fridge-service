<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show(Device $device)
    {
        $ttl = now()->addMinutes(20);
        $brands = Cache::remember("device:{$device->id}:brands", $ttl, fn() => $device->brands()->get());
        $problems = Cache::remember("device:{$device->id}:problems", $ttl, fn() => $device->problems()
            ->where('is_active', true)
            ->whereDoesntHave('brands')
            ->get());
        $errorCodes = Cache::remember("errorcodes:device:{$device->id}", $ttl, fn() => $device->errorCodes()
            ->with('brand')
            ->whereNotNull('slug')
            ->whereNotNull('brand_id')
            ->where('is_active', true)
            ->orderBy('code')
            ->get());
        $services = Cache::remember("device:{$device->id}:services", $ttl, fn() => $device->services()->with('prices.brands')->get());
        $faqs = Cache::remember("faqs:device:{$device->id}", $ttl, fn() => Faq::query()
            ->where('device_id', $device->id)
            ->whereNull('brand_id')
            ->whereNull('service_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
        $galleries = Cache::remember("gallery:device:{$device->id}", $ttl, fn() => Gallery::query()
            ->where('device_id', $device->id)
            ->orderBy('sort_order')
            ->get());

        // Reviews about this device first, then the rest, so the hub leads
        // with relevant ones while the rating still reflects every review.
        $reviews = Cache::remember("reviews:device:{$device->id}", $ttl, fn() => Review::with(['device', 'brand', 'service'])
            ->published()
            ->orderByRaw('device_id = ? desc', [$device->id])
            ->orderByDesc('is_featured')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get());

        return view('pages.device', [
            'device' => $device,
            'brands'  => $brands,
            'problems' => $problems,
            'errorCodes' => $errorCodes,
            'services' => $services,
            'faqs'     => $faqs,
            'galleries' => $galleries,
            'reviews' => $reviews,
        ]);
    }
}
