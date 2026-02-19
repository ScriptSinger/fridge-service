<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('type', 'about')->first();
        $galleries = $page
            ? Gallery::where('page_id', $page->id)->orderBy('sort_order')->get()
            : collect();
        $faqs = $page
            ? Faq::query()
                ->whereNull('device_id')
                ->whereNull('brand_id')
                ->where('page_id', $page->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('pages.about', [
            'page' => $page,
            'galleries' => $galleries,
            'faqs' => $faqs,
        ]);
    }
}
