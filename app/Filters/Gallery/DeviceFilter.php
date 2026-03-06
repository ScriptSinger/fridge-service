<?php

namespace App\Filters\Gallery;

use Closure;

class DeviceFilter
{
    public function handle(array $payload, Closure $next): array
    {
        $device = (string) ($payload['filters']['device'] ?? 'all');

        if ($device !== 'all') {
            $payload['query']->whereHas('device', function ($query) use ($device) {
                $query->whereRaw('LOWER(type) = ?', [$device]);
            });
        }

        return $next($payload);
    }
}

