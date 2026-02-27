<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Review extends Model
{
    protected $fillable = [
        'name',
        'title',
        'text',
        'rating',
        'avatar',
        'source',
        'city',
        'device_id',
        'brand_id',
        'service_id',
        'is_featured',
        'is_published',
        'published_at',
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
        'rating'       => 'integer',
        'published_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getPublishedDateAttribute(): ?\Illuminate\Support\Carbon
    {
        return $this->published_at ?? $this->created_at;
    }






    // Полная дата в формате «15 ноября 2025»
    public function getPublishedDateFormattedAttribute()
    {
        return $this->published_at?->locale('ru')->translatedFormat('j F Y');
    }

    // Метаданные устройства/бренда/услуги
    public function getMetaStringAttribute()
    {
        return collect([$this->device?->type, $this->brand?->name, $this->service?->name])
            ->filter()
            ->implode(' • ');
    }

    // Аватарка или первая буква имени
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return Storage::disk(config('filesystems.media'))->url($this->avatar);
        }
        return null;
    }

    // Рейтинг по умолчанию
    public function getRatingValueAttribute()
    {
        return $this->rating ?: 0;
    }
}
