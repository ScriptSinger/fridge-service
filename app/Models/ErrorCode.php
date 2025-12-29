<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ErrorCode extends Model
{
    use Sluggable;

    protected $fillable = [
        'brand_id',
        'code',
        'title',
        'description'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
}
