<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BrandDevice extends Model
{
    protected $table = 'brand_device';

    protected static function booted(): void
    {
        // Reordering in the admin should show on the hub right away, not after the 20-min cache
        $forget = fn (self $link) => Cache::forget("device:{$link->device_id}:brands");
        static::saved($forget);
        static::deleted($forget);
    }

    protected $fillable = [
        'brand_id',
        'device_id',
        'sort_order',
        'h1',
        'subtitle',
        'title',
        'description',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
