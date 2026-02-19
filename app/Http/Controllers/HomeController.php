<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('type', 'home')->first();
        $faqs = Faq::query()
            ->whereNull('device_id')
            ->whereNull('brand_id')
            ->where('is_active', true)
            ->when(
                $page,
                fn($query) => $query->where(function ($subQuery) use ($page) {
                    $subQuery->whereNull('page_id')
                        ->orWhere('page_id', $page->id);
                }),
                fn($query) => $query->whereNull('page_id')
            )
            ->orderBy('sort_order')
            ->get();

        $galleries = $page
            ? Gallery::where('page_id', $page->id)->orderBy('sort_order')->get()
            : collect();


        return view('pages.home', [
            'page' => Page::where('type', 'home')->firstOrFail(),
            'devices'   => Device::where('is_active', true)->get(),
            'galleries' => $galleries,
            'faqs' => $faqs
        ]);
    }
}
