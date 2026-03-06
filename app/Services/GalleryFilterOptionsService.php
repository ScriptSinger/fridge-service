<?php

namespace App\Services;

use App\Models\Gallery;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GalleryFilterOptionsService
{
    public function getBrandOptions(DateTimeInterface $ttl): Collection
    {
        return Cache::remember('gallery:brands', $ttl, function (): Collection {
            return Gallery::query()
                ->hasImage()
                ->join('brands', 'galleries.brand_id', '=', 'brands.id')
                ->selectRaw('LOWER(brands.name) as option_key, brands.name as option_label')
                ->distinct()
                ->orderBy('brands.name')
                ->get()
                ->mapWithKeys(fn($row) => [(string) $row->option_key => (string) $row->option_label]);
        });
    }

    public function getDeviceOptions(DateTimeInterface $ttl): Collection
    {
        return Cache::remember('gallery:devices', $ttl, function (): Collection {
            return Gallery::query()
                ->hasImage()
                ->join('devices', 'galleries.device_id', '=', 'devices.id')
                ->selectRaw('LOWER(devices.type) as option_key, devices.type as option_label')
                ->distinct()
                ->orderBy('devices.type')
                ->get()
                ->mapWithKeys(fn($row) => [(string) $row->option_key => (string) $row->option_label]);
        });
    }

    public function normalizeActiveOption(string $active, Collection $options): string
    {
        if ($active !== 'all' && ! $options->has($active)) {
            return 'all';
        }

        return $active;
    }
}
