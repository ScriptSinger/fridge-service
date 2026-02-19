<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        $ttl = now()->addMinutes(20);
        $page = Cache::remember('page:type:contacts', $ttl, fn() => Page::where('type', 'contacts')->first());
        $faqs = $page
            ? Cache::remember("faqs:page:{$page->id}", $ttl, fn() => Faq::query()
                ->whereNull('device_id')
                ->whereNull('brand_id')
                ->where('page_id', $page->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get())
            : collect();

        return view('pages.contacts', [
            'page' => $page,
            'faqs' => $faqs,
        ]);
    }
}
