<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use Sluggable;

    protected $fillable = [
        'slug',
        'permalink',
        'type',
        'h1',
        'subtitle',
        'title',
        'description',
        'image',
        'image_alt',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'permalink'
            ]
        ];
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class)->withPivot(['h1', 'subtitle', 'title', 'description']);
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
        $type = $this->type;
        return $map[$type][$case] ?? Str::lower($type);
    }
}
