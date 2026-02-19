<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;

class ContactController extends Controller
{
    public function index()
    {
        $page = Page::where('type', 'contacts')->first();
        $faqs = $page
            ? Faq::query()
                ->whereNull('device_id')
                ->whereNull('brand_id')
                ->where('page_id', $page->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('pages.contacts', [
            'page' => $page,
            'faqs' => $faqs,
        ]);
    }
}
