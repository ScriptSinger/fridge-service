<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $ttl = now()->addMinutes(20);
        $allowedSorts = ['newest', 'oldest'];
        $sort = strtolower((string) $request->query('sort', 'newest'));
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'newest';
        }

        $activeBrand = strtolower((string) $request->query('brand', 'all'));
        $activeDevice = strtolower((string) $request->query('device', 'all'));

        $brandOptions = Cache::remember('gallery:brands', $ttl, function (): Collection {
            return Gallery::query()
                ->join('brands', 'galleries.brand_id', '=', 'brands.id')
                ->whereNotNull('galleries.image')
                ->where('galleries.image', '!=', '')
                ->selectRaw('LOWER(brands.name) as option_key, brands.name as option_label')
                ->distinct()
                ->orderBy('brands.name')
                ->get()
                ->mapWithKeys(fn($row) => [(string) $row->option_key => (string) $row->option_label]);
        });

        $deviceOptions = Cache::remember('gallery:devices', $ttl, function (): Collection {
            return Gallery::query()
                ->join('devices', 'galleries.device_id', '=', 'devices.id')
                ->whereNotNull('galleries.image')
                ->where('galleries.image', '!=', '')
                ->selectRaw('LOWER(devices.type) as option_key, devices.type as option_label')
                ->distinct()
                ->orderBy('devices.type')
                ->get()
                ->mapWithKeys(fn($row) => [(string) $row->option_key => (string) $row->option_label]);
        });

        if ($activeBrand !== 'all' && ! $brandOptions->has($activeBrand)) {
            $activeBrand = 'all';
        }
        if ($activeDevice !== 'all' && ! $deviceOptions->has($activeDevice)) {
            $activeDevice = 'all';
        }

        $galleriesQuery = Gallery::query()
            ->with(['device', 'brand', 'service'])
            ->whereNotNull('image')
            ->where('image', '!=', '');

        if ($activeBrand !== 'all') {
            $galleriesQuery->whereHas('brand', function ($query) use ($activeBrand) {
                $query->whereRaw('LOWER(name) = ?', [$activeBrand]);
            });
        }

        if ($activeDevice !== 'all') {
            $galleriesQuery->whereHas('device', function ($query) use ($activeDevice) {
                $query->whereRaw('LOWER(type) = ?', [$activeDevice]);
            });
        }

        $galleriesQuery = match ($sort) {
            'oldest' => $galleriesQuery
                ->orderByRaw('COALESCE(published_at, created_at) ASC')
                ->orderBy('created_at'),
            default => $galleriesQuery
                ->orderByRaw('COALESCE(published_at, created_at) DESC')
                ->orderByDesc('created_at'),
        };

        $galleries = $galleriesQuery
            ->paginate(24)
            ->withQueryString();

        return view('pages.gallery', [
            'galleries' => $galleries,
            'total' => $galleries->total(),
            'brandOptions' => ['all' => 'Все бренды'] + $brandOptions->all(),
            'deviceOptions' => ['all' => 'Вся техника'] + $deviceOptions->all(),
            'activeBrand' => $activeBrand,
            'activeDevice' => $activeDevice,
        ]);
    }
}
