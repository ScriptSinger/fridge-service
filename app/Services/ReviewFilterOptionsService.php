<?php

namespace App\Services;

use App\Models\Review;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ReviewFilterOptionsService
{
    public function getSourceOptions(DateTimeInterface $ttl): Collection
    {
        return Cache::remember('reviews:sources', $ttl, function (): Collection {
            return Review::query()
                ->published()
                ->hasSource()
                ->selectRaw('LOWER(source) as source_key')
                ->distinct()
                ->orderBy('source_key')
                ->pluck('source_key')
                ->map(fn($source) => (string) $source);
        });
    }

    public function normalizeActiveSource(string $activeSource, Collection $sourceOptions): string
    {
        if ($activeSource !== 'all' && ! $sourceOptions->contains($activeSource)) {
            return 'all';
        }

        return $activeSource;
    }

    public function getStats(string $activeSource, DateTimeInterface $ttl): object
    {
        return Cache::remember("reviews:stats:{$activeSource}", $ttl, function () use ($activeSource) {
            return Review::query()
                ->published()
                ->forSource($activeSource)
                ->selectRaw('ROUND(AVG(rating), 1) as avg_rating, COUNT(*) as total')
                ->first();
        });
    }

    public function buildSourceLabels(Collection $sourceOptions): array
    {
        $sourceLabels = ['all' => 'Все источники'];
        foreach ($sourceOptions as $sourceOption) {
            $source = (string) $sourceOption;
            $sourceLabels[$source] = mb_strtoupper(mb_substr($source, 0, 1)) . mb_substr($source, 1);
        }

        return $sourceLabels;
    }
}

