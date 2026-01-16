<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Problem;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'page' => Page::where('type', 'home')->firstOrFail(),
            'services'   => Service::where('is_active', true)->get(),
            'problems'   => Problem::limit(6)->get(),
        ]);
    }
}
