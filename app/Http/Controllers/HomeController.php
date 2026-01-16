<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'services'   => Service::where('is_active', true)->get(),
            'problems'   => Problem::limit(6)->get(),
        ]);
    }
}
