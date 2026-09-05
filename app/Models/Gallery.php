<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    use HasImageUrl;
    use Sluggable;

    protected static function booted(): void
    {
        static::saved(function (Gallery $gallery) {
            $gallery->clearFrontendCache();
            $gallery->clearFrontendCache($gallery->getOriginal());
        });
        static::deleted(fn (Gallery $gallery) => $gallery->clearFrontendCache());
    }

    protected $fillable = [
        'device_id',
        'brand_id',
        'service_id',
        'problem_id',
        'error_code_id',
        'page_id',
        'slug',
        'title',
        'subtitle',
        'seo_title',
        'seo_description',
        'description',
        'image',
        'image_alt',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeHasImage($query)
    {
        $imageColumn = $query->getModel()->qualifyColumn('image');

        return $query
            ->whereNotNull($imageColumn)
            ->where($imageColumn, '!=', '');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function errorCode()
    {
        return $this->belongsTo(ErrorCode::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function getPublishedDateFormattedAttribute(): ?string
    {
        return $this->published_date?->locale('ru')->translatedFormat('j F Y');
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at ?? $this->created_at;
    }

    /**
     * Сбрасывает кэш списков, в которых показывается эта галерея. Принимает
     * необязательный набор атрибутов, чтобы очистить кэш и по прежним
     * значениям связей — на случай, если галерею перепривязали к другой
     * проблеме/коду ошибки/бренду.
     */
    public function clearFrontendCache(?array $attributes = null): void
    {
        $problemId = $attributes['problem_id'] ?? $this->problem_id;
        $errorCodeId = $attributes['error_code_id'] ?? $this->error_code_id;
        $deviceId = $attributes['device_id'] ?? $this->device_id;
        $brandId = $attributes['brand_id'] ?? $this->brand_id;

        if ($problemId) {
            Cache::forget("gallery:problem:{$problemId}");
        }

        if ($errorCodeId) {
            Cache::forget("gallery:error-code:{$errorCodeId}");
        }

        if ($deviceId && $brandId) {
            Cache::forget("gallery:device:{$deviceId}:brand:{$brandId}");
        }
    }
}
