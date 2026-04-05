<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Price;

class Service extends Model
{
    use Sluggable;
    use HasImageUrl;

    protected $fillable = [
        'name',
        'description',
        'device_id',
        'slug',
        'tags',
        'is_active',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
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

    public function preferredPrice(?int $deviceId = null, ?int $brandId = null): ?Price
    {
        $prices = $this->relationLoaded('prices') ? $this->prices : $this->prices()->get();

        if (! is_null($brandId)) {
            return $prices
                ->filter(fn (Price $item) => $item->device_id === $deviceId && $item->appliesToBrand($brandId))
                ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                ->first()
                ?? $prices
                    ->filter(fn (Price $item) => $item->appliesToBrand($brandId))
                    ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                    ->first()
                ?? $prices
                    ->filter(fn (Price $item) => $item->device_id === $deviceId && $item->brands->isEmpty())
                    ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                    ->first()
                ?? $prices
                    ->filter(fn (Price $item) => $item->brands->isEmpty())
                    ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                    ->first()
                ?? $prices
                    ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                    ->first();
        }

        return $prices
            ->filter(fn (Price $item) => $item->device_id === $deviceId && $item->brands->isEmpty())
            ->sortByDesc(fn ($item) => ! is_null($item->price_from))
            ->first()
            ?? $prices
                ->filter(fn (Price $item) => $item->brands->isEmpty())
                ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                ->first()
            ?? $prices
                ->sortByDesc(fn ($item) => ! is_null($item->price_from))
                ->first();
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
