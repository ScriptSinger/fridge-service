<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
        'rating'       => 'integer',
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
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
