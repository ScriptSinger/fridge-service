<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show(Device $device)
    {
        $device->load('brands', 'problems', 'services', 'faqs');
        $galleries = Gallery::query()
            ->where('device_id', $device->id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.device', [
            'device' => $device,
            'brands'  => $device->brands,
            'problems' => $device->problems,
            'services' => $device->services,
            'faqs'     => $device->faqs,
            'galleries' => $galleries,
        ]);
    }
}
