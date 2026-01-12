<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($slug)
    {
        $service = Service::with('brands')->where('slug', $slug)->firstOrFail();
        return view('pages.services.show', [
            'service' => $service,
            'brands'  => $service->brands,
        ]);
    }
}
