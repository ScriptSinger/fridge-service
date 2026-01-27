<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceBrandController extends Controller
{
    public function show(Device $device, Brand $brand)
    {
        return view('pages.brand', [
            'device' => $device,
            'brand'   => $brand,
        ]);
    }
}
