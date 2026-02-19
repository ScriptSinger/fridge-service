<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\File;

trait InteractsWithMediaMap
{
    protected function mediaMap(): array
    {
        static $map = null;

        if (is_array($map)) {
            return $map;
        }

        $path = resource_path('content/media-map.json');

        if (! File::exists($path)) {
            return $map = [];
        }

        $decoded = json_decode((string) File::get($path), true);

        return $map = is_array($decoded) ? $decoded : [];
    }
}
