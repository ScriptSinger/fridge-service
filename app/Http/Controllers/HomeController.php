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
        $faqs = Faq::whereNull('device_id')   // общие FAQ
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $page = Page::where('type', 'home')->first();
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
