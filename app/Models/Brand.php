<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Sluggable;
    use HasImageUrl;

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

    public function faqs()
    {
        return $this->hasMany(Faq::class)->where('is_active', true);
    }

    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }
}
