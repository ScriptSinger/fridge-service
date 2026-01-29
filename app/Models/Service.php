<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'description',
        'device_id',
        'brand_id',
        'slug',
        'tags',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'permalink'
            ]
        ];
    }

    /**
     * Связь с устройством (Device)
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Связь с ценой (Price)
     */
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    /**
     * Связь с проблемами (Problem) через pivot
     */
    public function problems()
    {
        return $this->belongsToMany(Problem::class, 'problem_service');
    }

    /**
     * Преобразуем JSON теги в массив
     */
    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * Удобный аксессор для SEO / фронтенда
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name; // можно добавить доп. текст, если нужно
    }
}
