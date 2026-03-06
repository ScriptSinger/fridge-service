<?php

namespace App\Filters\Gallery;

use Closure;

class BrandFilter
{
    public function handle(array $payload, Closure $next): array
    {
        $brand = (string) ($payload['filters']['brand'] ?? 'all');

        if ($brand !== 'all') {
            $payload['query']->whereHas('brand', function ($query) use ($brand) {
                $query->whereRaw('LOWER(name) = ?', [$brand]);
            });
        }

        return $next($payload);
    }
}

