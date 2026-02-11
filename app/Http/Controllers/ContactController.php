<?php

namespace App\Http\Controllers;

use App\Models\Page;

class ContactController extends Controller
{
    public function index()
    {
        $page = Page::where('type', 'contacts')->first();

        return view('pages.contacts', [
            'page' => $page,
        ]);
    }
}
