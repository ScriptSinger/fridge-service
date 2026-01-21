<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceBrandController extends Controller
{
    public function show(Service $service, Brand $brand)
    {
        return view('pages.brand', [
            'service' => $service,
            'brand'   => $brand,
        ]);
    }
}
