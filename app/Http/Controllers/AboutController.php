<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    public function index()
    {
        $ttl = now()->addMinutes(20);
        $page = Cache::remember('page:type:about', $ttl, fn() => Page::where('type', 'about')->first());
        $galleries = $page
            ? Cache::remember("gallery:page:{$page->id}", $ttl, fn() => Gallery::where('page_id', $page->id)->orderBy('sort_order')->get())
            : collect();
        $faqs = $page
            ? Cache::remember("faqs:page:{$page->id}", $ttl, fn() => Faq::query()
                ->whereNull('device_id')
                ->whereNull('brand_id')
                ->where('page_id', $page->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get())
            : collect();

        return view('pages.about', [
            'page' => $page,
            'galleries' => $galleries,
            'faqs' => $faqs,
        ]);
    }
}
