<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $ttl = now()->addMinutes(20);

        $galleries = Cache::remember('gallery:published', $ttl, function () {
            return Gallery::with(['device', 'brand', 'service'])
                ->whereNotNull('image')
                ->orderByDesc('created_at')
                ->get();
        });

        $sort = $request->query('sort', 'newest');

        $galleries = match ($sort) {
            'oldest' => $galleries->sortBy(fn(Gallery $item) => $item->created_at?->timestamp ?? 0)->values(),
            default => $galleries->sortByDesc(fn(Gallery $item) => $item->created_at?->timestamp ?? 0)->values(),
        };

        return view('pages.gallery', [
            'galleries' => $galleries,
        ]);
    }
}
