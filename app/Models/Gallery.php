<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasImageUrl;

    protected $fillable = [
        'device_id',
        'brand_id',
        'service_id',
        'page_id',
        'title',
        'subtitle',
        'description',
        'image',
        'image_alt',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

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
}
