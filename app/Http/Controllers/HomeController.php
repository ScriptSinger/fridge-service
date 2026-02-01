<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Problem;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faqs = Faq::whereNull('device_id')   // общие FAQ
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.home', [
            'page' => Page::where('type', 'home')->firstOrFail(),
            'devices'   => Device::where('is_active', true)->get(),
            'problems'   => Problem::limit(6)->get(),
            'faqs' => $faqs
        ]);
    }
}
