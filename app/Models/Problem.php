<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Problem extends Model
{
    use Sluggable;

    protected static function booted(): void
    {
        static::saved(fn (Problem $problem) => $problem->clearFrontendCache());
        static::deleted(fn (Problem $problem) => $problem->clearFrontendCache());
    }

    protected $fillable = [
        'device_id',
        'slug',
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

    public function services()
    {
        return $this->belongsToMany(Service::class, 'problem_service');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_problem');
    }

    public function errorCodes()
    {
        return $this->belongsToMany(ErrorCode::class, 'error_code_problem');
    }

    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }

    public function getShortContentAttribute()
    {
        return Str::limit(html_entity_decode(strip_tags($this->content), ENT_QUOTES, 'UTF-8'), 70);
    }

    public function clearFrontendCache(): void
    {
        if (! $this->device_id) {
            return;
        }

        Cache::forget("device:{$this->device_id}:problems");

        if ($this->slug) {
            Cache::forget("problem:device:{$this->device_id}:{$this->slug}");
        }

        $device = Device::query()
            ->with('brands:id')
            ->find($this->device_id);

        foreach ($device?->brands ?? [] as $brand) {
            Cache::forget("problems:device:{$this->device_id}:brand:{$brand->id}");
        }
    }
}
