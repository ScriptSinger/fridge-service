<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    use Sluggable;
    use HasImageUrl;

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

    public function problems()
    {
        return $this->hasMany(Problem::class)->where('is_active', true);
    }

    public function services()
    {
        return $this->hasMany(Service::class)->where('is_active', true);;
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class)
            ->whereNull('brand_id')
            ->where('is_active', true);
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
