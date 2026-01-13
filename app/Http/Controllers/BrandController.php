<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Service;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show(Service $service, Brand $brand)
    {
        abort_unless(
            $service->brands()->where('brands.id', $brand->id)->exists(),
            404
        );

        return view('pages.brands.show', [
            'service' => $service,
            'brand'   => $brand,
        ]);
    }
}
