<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable;
    use HasImageUrl;

    protected $fillable = [
        'slug',
        'page_type_id',
        'h1',
        'subtitle',
        'title',
        'description',
        'content',
        'image',
        'image_alt',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'h1'
            ]
        ];
    }

    public function pageType()
    {
        return $this->belongsTo(PageType::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function findByType(string $key): self
    {
        return self::whereHas('pageType', fn($q) => $q->where('key', $key))->firstOrFail();
    }
}
