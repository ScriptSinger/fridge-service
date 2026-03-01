<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Master;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    public function index()
    {
        $ttl = now()->addMinutes(20);
        $page = Cache::remember('page:type:about', $ttl, function () {
            return PageType::where('key', 'about')
                ->firstOrFail()
                ->page;
        });
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

        $masters = Cache::remember('masters:with-certificates', $ttl, function () {
            return Master::with('certificates')
                ->orderBy('id')
                ->get();
        });
        // В контроллере
        $certSlides = $masters
            ->flatMap(
                fn($master) => $master->certificates
                    ->filter(fn($cert) => !empty($cert->image))
            )
            ->values(); // это всё ещё коллекция Eloquent моделей

        return view('pages.about', [
            'page' => $page,
            'galleries' => $galleries,
            'faqs' => $faqs,
            'masters' => $masters,
            'certSlides' => $certSlides,
        ]);
    }
}
