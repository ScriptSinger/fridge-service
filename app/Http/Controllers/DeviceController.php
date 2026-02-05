<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show(Device $device)
    {
        $device->load('brands', 'problems', 'services', 'faqs');

        return view('pages.device', [
            'device' => $device,
            'brands'  => $device->brands,
            'problems' => $device->problems,
            'services' => $device->services,
            'faqs'     => $device->faqs,
        ]);
    }
}
