<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DeviceBrandController extends Controller
{
    public function show(Device $device, Brand $brand)
    {
        $problems = $brand->problems()
            ->where('device_id', $device->id)
            ->get();
        $galleries = Gallery::query()
            ->where('device_id', $device->id)
            ->where('brand_id', $brand->id)
            ->orderBy('sort_order')
            ->get();
        $brandFaqs = Faq::query()
            ->where('device_id', $device->id)
            ->where('brand_id', $brand->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.brand', [
            'device'   => $device,
            'brand'    => $brand,
            'problems' => $problems,
            'services' => $device->services,
            'galleries' => $galleries,
            'faqs' => $brandFaqs,
        ]);
    }
}
