<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewIndexRequest;
use App\Models\Review;
use App\Pipelines\ReviewPipeline;
use App\Services\ReviewFilterOptionsService;

class ReviewController extends Controller
{
    public function index(ReviewIndexRequest $request, ReviewFilterOptionsService $filterOptionsService)
    {
        $ttl = now()->addMinutes(20);
        $sort = $request->sort();
        $activeSource = $request->source();

        $sourceOptions = $filterOptionsService->getSourceOptions($ttl);
        $activeSource = $filterOptionsService->normalizeActiveSource($activeSource, $sourceOptions);

        $reviewsQuery = Review::query()
            ->with(['device', 'brand', 'service'])
            ->published();

        $reviewsQuery = ReviewPipeline::apply($reviewsQuery, [
            'source' => $activeSource,
            'sort' => $sort,
        ]);

        $reviews = $reviewsQuery
            ->paginate(24)
            ->withQueryString();

        $stats = $filterOptionsService->getStats($activeSource, $ttl);
        $sourceLabels = $filterOptionsService->buildSourceLabels($sourceOptions);

        return view('pages.reviews', [
            'reviews' => $reviews,
            'avgRating' => (float) ($stats?->avg_rating ?? 0),
            'totalReviews' => (int) ($stats?->total ?? 0),
            'sourceLabels' => $sourceLabels,
            'activeSource' => $activeSource,
        ]);
    }
}
