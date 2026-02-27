<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\PageType;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ttl = now()->addMinutes(20);
        $page = Cache::remember('page:type:home', $ttl, function () {
            return PageType::where('key', 'home')
                ->firstOrFail()
                ->page;
        });

        $faqs = Cache::remember("faqs:page:{$page->id}", $ttl, function () use ($page) {
            return Faq::query()
                ->whereNull('device_id')
                ->whereNull('brand_id')
                ->where('is_active', true)
                ->where(function ($subQuery) use ($page) {
                    $subQuery->whereNull('page_id')
                        ->orWhere('page_id', $page->id);
                })
                ->orderBy('sort_order')
                ->get();
        });
        $galleries = Cache::remember("gallery:page:{$page->id}", $ttl, function () use ($page) {
            return Gallery::where('page_id', $page->id)->orderBy('sort_order')->get();
        });
        $devices = Cache::remember('devices:active', $ttl, fn() => Device::where('is_active', true)->get());
        $reviews = Cache::remember('reviews:home', $ttl, function () {
            return Review::with(['device', 'brand', 'service'])
                ->published()
                ->orderByDesc('is_featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->get();
        });


        return view('pages.home', [
            'page' => $page,
            'devices'   => $devices,
            'galleries' => $galleries,
            'faqs' => $faqs,
            'reviews' => $reviews,
        ]);
    }
}
