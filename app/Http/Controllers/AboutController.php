<?php

namespace App\Http\Controllers;

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

        return view('pages.about', [
            'page' => $page,
            'galleries' => $galleries,
        ]);
    }
}
