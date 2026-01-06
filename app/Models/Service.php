<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'h1',
        'excerpt',
        'description',
        'image',
        'image_alt',
        'content',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 120);
    }
}
