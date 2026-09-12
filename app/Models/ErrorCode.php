<?php

namespace App\Models;

use App\Models\Concerns\RecordsSlugRedirects;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ErrorCode extends Model
{
    use RecordsSlugRedirects;
    use Sluggable;

    protected static function booted(): void
    {
        static::saved(function (ErrorCode $errorCode) {
            $errorCode->recordSlugRedirect();
            $errorCode->clearFrontendCache();
        });
        static::deleted(fn (ErrorCode $errorCode) => $errorCode->clearFrontendCache());
    }

    protected $fillable = [
        'device_id',
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

    public function device()
    {
        return $this->belongsTo(Device::class);
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

    protected function slugRedirectPath(string $slug): ?string
    {
        if (! $this->device) {
            return null;
        }

        return parse_url(route('error-codes.show', [$this->device, $slug]), PHP_URL_PATH);
    }

    public function clearFrontendCache(): void
    {
        if (! $this->device_id || ! $this->brand_id) {
            return;
        }

        Cache::forget("errorcodes:device:{$this->device_id}:brand:{$this->brand_id}");
    }
}
