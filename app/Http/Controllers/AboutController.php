<?php

namespace App\Http\Controllers;

use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('type', 'about')->first();

        return view('pages.about', [
            'page' => $page,
        ]);
    }
}
