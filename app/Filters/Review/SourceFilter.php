<?php

namespace App\Filters\Review;

use Closure;

class SourceFilter
{
    public function handle(array $payload, Closure $next): array
    {
        $source = (string) ($payload['filters']['source'] ?? 'all');

        $payload['query']->forSource($source);

        return $next($payload);
    }
}

