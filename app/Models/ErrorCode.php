<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ErrorCode extends Model
{
    use Sluggable;

    protected static function booted(): void
    {
        static::saved(fn (ErrorCode $errorCode) => $errorCode->clearFrontendCache());
        static::deleted(fn (ErrorCode $errorCode) => $errorCode->clearFrontendCache());
    }

    protected $fillable = [
        'brand_id',
        'code',
        'title',
        'h1',
        'subtitle',
        'seo_title',
        'seo_description',
        'content',
        'is_active',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    public function getShortContentAttribute()
    {
        return Str::limit(html_entity_decode(strip_tags((string) $this->content), ENT_QUOTES, 'UTF-8'), 70);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function problems()
    {
        return $this->belongsToMany(Problem::class);
    }

    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }

    public function clearFrontendCache(): void
    {
        if (! $this->brand_id) {
            return;
        }

        $deviceIds = $this->brand?->devices()->pluck('devices.id') ?? collect();

        foreach ($deviceIds as $deviceId) {
            Cache::forget("errorcodes:device:{$deviceId}:brand:{$this->brand_id}");
        }
    }
}
