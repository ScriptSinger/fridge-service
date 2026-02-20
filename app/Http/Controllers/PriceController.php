<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\PageType;

class PriceController extends Controller
{
    public function index()
    {
        $devices = Device::with(['services.prices'])
            ->where('is_active', true)
            ->get();

        $page = PageType::where('key', 'prices')
            ->firstOrFail()
            ->page;

        return view('pages.prices', [
            'page' => $page,
            'devices' => $devices,
        ]);
    }
}
