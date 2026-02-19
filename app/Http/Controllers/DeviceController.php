<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Gallery;
use App\Models\Faq;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show(Device $device)
    {
        $ttl = now()->addMinutes(20);
        $brands = Cache::remember("device:{$device->id}:brands", $ttl, fn() => $device->brands()->get());
        $problems = Cache::remember("device:{$device->id}:problems", $ttl, fn() => $device->problems()->get());
        $services = Cache::remember("device:{$device->id}:services", $ttl, fn() => $device->services()->get());
        $faqs = Cache::remember("faqs:device:{$device->id}", $ttl, fn() => Faq::query()
            ->where('device_id', $device->id)
            ->whereNull('brand_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
        $galleries = Cache::remember("gallery:device:{$device->id}", $ttl, fn() => Gallery::query()
            ->where('device_id', $device->id)
            ->orderBy('sort_order')
            ->get());

        return view('pages.device', [
            'device' => $device,
            'brands'  => $brands,
            'problems' => $problems,
            'services' => $services,
            'faqs'     => $faqs,
            'galleries' => $galleries,
        ]);
    }
}
