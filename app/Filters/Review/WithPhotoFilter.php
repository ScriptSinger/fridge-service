<?php

namespace App\Filters\Review;

use Closure;

class WithPhotoFilter
{
    public function handle(array $payload, Closure $next): array
    {
        $withPhoto = (bool) ($payload['filters']['with_photo'] ?? false);

        if ($withPhoto) {
            $payload['query']->hasImage();
        }

        return $next($payload);
    }
}

