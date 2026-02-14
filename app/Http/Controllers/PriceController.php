<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Page;

class PriceController extends Controller
{
    public function index()
    {
        $devices = Device::with(['services.prices'])
            ->where('is_active', true)
            ->get();

        return view('pages.prices', [
            'page' => Page::where('type', 'home')->firstOrFail(),
            'devices' => $devices,
        ]);
    }
}
