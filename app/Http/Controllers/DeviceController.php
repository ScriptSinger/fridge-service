<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show($slug)
    {
        $device = Device::with('brands', 'problems', 'services', 'faqs')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.device', [
            'device' => $device,
            'brands'  => $device->brands,
            'problems' => $device->problems,
            'services' => $device->services,
            'faqs'     => $device->faqs,
        ]);
    }
}
