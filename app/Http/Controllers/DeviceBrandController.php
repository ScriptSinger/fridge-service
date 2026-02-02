<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceBrandController extends Controller
{
    public function show(Device $device, Brand $brand)
    {
        $problems = $brand->problems()
            ->where('device_id', $device->id)
            ->get();

        return view('pages.brand', [
            'device'   => $device,
            'brand'    => $brand,
            'problems' => $problems,
            'services' => $device->services,
        ]);
    }
}
