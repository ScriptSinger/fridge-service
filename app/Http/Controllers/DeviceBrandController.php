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
        $galleries = Cache::remember("gallery:device:{$device->id}:brand:{$brand->id}", $ttl, fn() => Gallery::query()
            ->where('device_id', $device->id)
            ->where('brand_id', $brand->id)
            ->orderBy('sort_order')
            ->get());
        $brandFaqs = Cache::remember("faqs:device:{$device->id}:brand:{$brand->id}", $ttl, fn() => Faq::query()
            ->where('device_id', $device->id)
            ->where('brand_id', $brand->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
        $services = Cache::remember("device:{$device->id}:services", $ttl, fn() => $device->services()->get());

        return view('pages.brand', [
            'device'   => $device,
            'brand'    => $brand,
            'problems' => $problems,
            'services' => $services,
            'galleries' => $galleries,
            'faqs' => $brandFaqs,
            'title' => $brand->pivot->title ?: $device->title,
            'description' => $brand->pivot->description ?: $device->description,
        ]);
    }
}
