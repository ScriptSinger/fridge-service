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
        'type',
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

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }


    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 120);
    }

    /**
     * Получить название типа техники в нужном падеже
     *
     * @param string $case 'nominative', 'genitive', 'dative', 'accusative', 'instrumental', 'prepositional'
     * @return string
     */
    public function typeInCase(string $case = 'nominative'): string
    {
        $map = config('tech_types');
        $type = $this->type; // поле модели type
        return $map[$type][$case] ?? Str::lower($type);
    }
}
