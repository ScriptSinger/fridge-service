<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function show($slug)
    {
        $service = Service::with('brands')->where('slug', $slug)->firstOrFail();
        $problems = Problem::whereHas('service', function ($query) use ($service) {
            $query->where('type', $service->type);
        })
            ->whereDoesntHave('brands')
            ->get();

        return view('pages.service', [
            'service' => $service,
            'brands'  => $service->brands,
            'problems' => $problems

        ]);
    }
}
