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
        'description'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
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
