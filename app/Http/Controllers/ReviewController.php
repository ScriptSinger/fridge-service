<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $ttl = now()->addMinutes(20);
        $allowedSorts = ['newest', 'oldest', 'positive', 'negative'];
        $sort = strtolower((string) $request->query('sort', 'newest'));
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'newest';
        }

        $activeSource = strtolower((string) $request->query('source', 'all'));

        $sourceOptions = Cache::remember('reviews:sources', $ttl, function (): Collection {
            return Review::query()
                ->published()
                ->whereNotNull('source')
                ->select('source')
                ->distinct()
                ->pluck('source')
                ->map(fn($source) => strtolower((string) $source))
                ->filter()
                ->unique()
                ->values();
        });

        if ($activeSource !== 'all' && ! $sourceOptions->contains($activeSource)) {
            $activeSource = 'all';
        }

        $reviewsQuery = Review::query()
            ->with(['device', 'brand', 'service'])
            ->published();

        if ($activeSource !== 'all') {
            $reviewsQuery->whereRaw('LOWER(source) = ?', [$activeSource]);
        }

        $reviewsQuery = match ($sort) {
            'oldest' => $reviewsQuery
                ->orderBy('published_at')
                ->orderBy('created_at'),
            'positive' => $reviewsQuery
                ->orderByDesc('rating')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at'),
            'negative' => $reviewsQuery
                ->orderBy('rating')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at'),
            default => $reviewsQuery
                ->orderByDesc('is_featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at'),
        };

        $reviews = $reviewsQuery
            ->paginate(24)
            ->withQueryString();

        $stats = Cache::remember("reviews:stats:{$activeSource}", $ttl, function () use ($activeSource) {
            $statsQuery = Review::query()->published();
            if ($activeSource !== 'all') {
                $statsQuery->whereRaw('LOWER(source) = ?', [$activeSource]);
            }

            return $statsQuery
                ->selectRaw('ROUND(AVG(rating), 1) as avg_rating, COUNT(*) as total')
                ->first();
        });

        $sourceLabels = ['all' => 'Все источники'];
        foreach ($sourceOptions as $sourceOption) {
            $sourceLabels[$sourceOption] = mb_strtoupper(mb_substr($sourceOption, 0, 1)) . mb_substr($sourceOption, 1);
        }

        return view('pages.reviews', [
            'reviews' => $reviews,
            'avgRating' => (float) ($stats?->avg_rating ?? 0),
            'totalReviews' => (int) ($stats?->total ?? 0),
            'sourceLabels' => $sourceLabels,
            'activeSource' => $activeSource,
        ]);
    }
}
