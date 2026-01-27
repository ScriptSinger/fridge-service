<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Problem;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show($slug)
    {
        $device = Device::with('brands')->where('slug', $slug)->firstOrFail();
        $problems = Problem::whereHas('device', function ($query) use ($device) {
            $query->where('type', $device->type);
        })
            ->whereDoesntHave('brands')
            ->get();

        return view('pages.device', [
            'device' => $device,
            'brands'  => $device->brands,
            'problems' => $problems
        ]);
    }
}
