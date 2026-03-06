<?php

namespace App\Filters\Review;

use Closure;

class SortFilter
{
    public function handle(array $payload, Closure $next): array
    {
        $sort = (string) ($payload['filters']['sort'] ?? 'newest');

        $payload['query'] = match ($sort) {
            'oldest' => $payload['query']
                ->orderBy('published_at')
                ->orderBy('created_at'),
            'positive' => $payload['query']
                ->orderByDesc('rating')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at'),
            'negative' => $payload['query']
                ->orderBy('rating')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at'),
            default => $payload['query']
                ->orderByDesc('is_featured')
                ->orderByDesc('published_at')
                ->orderByDesc('created_at'),
        };

        return $next($payload);
    }
}

