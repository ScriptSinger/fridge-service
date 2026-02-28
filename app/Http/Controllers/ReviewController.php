<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $ttl = now()->addMinutes(20);

        $reviews = Cache::remember('reviews:published', $ttl, function () {
            return Review::with(['device', 'brand', 'service'])
                ->published()
                ->orderByDesc('is_featured')
                ->orderByDesc('created_at')
                ->get();
        });

        $sort = $request->query('sort', 'newest');

        $reviews = match ($sort) {
            'oldest' => $reviews
                ->sortBy(fn(Review $review) => $review->published_date?->timestamp ?? 0)
                ->values(),
            'positive' => $reviews
                ->sortByDesc(fn(Review $review) => [$review->rating_value, $review->published_date?->timestamp ?? 0])
                ->values(),
            'negative' => $reviews
                ->sortBy(fn(Review $review) => [$review->rating_value, -($review->published_date?->timestamp ?? 0)])
                ->values(),
            default => $reviews
                ->sortByDesc(fn(Review $review) => $review->published_date?->timestamp ?? 0)
                ->values(),
        };

        return view('pages.reviews', [
            'reviews' => $reviews,
        ]);
    }
}
