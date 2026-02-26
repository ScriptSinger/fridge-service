<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    public function index()
    {
        $ttl = now()->addMinutes(20);

        $reviews = Cache::remember('reviews:published', $ttl, function () {
            return Review::with(['device', 'brand', 'service'])
                ->published()
                ->orderByDesc('is_featured')
                ->orderByDesc('created_at')
                ->get();
        });

        return view('pages.reviews', [
            'reviews' => $reviews,
        ]);
    }
}
