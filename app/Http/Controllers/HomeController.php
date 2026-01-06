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



            'services'  => Service::where('is_active', true)->get(), // ремонт холодильников
            // 'brands'   => Brand::limit(8)->get(),
            'problems' => Problem::limit(6)->get(),


            $meta = [
                'title' => 'Ремонт холодильников в [Ваш город] | Repair Center',
                'description' => 'Профессиональный ремонт холодильников, быстрые выезды, гарантия на работы.',
                'keywords' => 'ремонт холодильников, сервис холодильников, выезд мастера',
            ]
        ]);
    }
}
