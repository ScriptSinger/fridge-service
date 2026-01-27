<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'image_alt',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function devices()
    {
        return $this->belongsToMany(Device::class);
    }

    public function problems()
    {
        return $this->belongsToMany(Problem::class, 'brand_problem');
    }

    public function errorCodes()
    {
        return $this->hasMany(ErrorCode::class);
    }

    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }
}
