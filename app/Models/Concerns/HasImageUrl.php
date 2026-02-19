<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasImageUrl
{
    public function getImageUrlAttribute(): ?string
    {
        $image = (string) ($this->image ?? '');

        if ($image === '') {
            return null;
        }

        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        return Storage::disk(config('filesystems.media'))->url($image);
    }
}
