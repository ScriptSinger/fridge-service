<?php

namespace App\Http\Controllers;

use App\Models\Device;

class PriceController extends Controller
{
    public function index()
    {
        $devices = Device::with(['services.prices'])
            ->where('is_active', true)
            ->get();

        return view('pages.prices', [
            'devices' => $devices,
        ]);
    }
}
