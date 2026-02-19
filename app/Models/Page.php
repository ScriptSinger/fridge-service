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
        'type',
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

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
