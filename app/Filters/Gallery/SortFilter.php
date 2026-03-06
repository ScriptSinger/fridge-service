<?php

namespace App\Filters\Gallery;

use Closure;

class SortFilter
{
    public function handle(array $payload, Closure $next): array
    {
        $sort = (string) ($payload['filters']['sort'] ?? 'newest');

        $payload['query'] = match ($sort) {
            'oldest' => $payload['query']
                ->orderByRaw('COALESCE(published_at, created_at) ASC')
                ->orderBy('created_at'),
            default => $payload['query']
                ->orderByRaw('COALESCE(published_at, created_at) DESC')
                ->orderByDesc('created_at'),
        };

        return $next($payload);
    }
}

