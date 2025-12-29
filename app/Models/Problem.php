<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use Sluggable;

    protected $fillable = [
        'slug',
        'title',
        'h1',
        'content'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
}
