<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Price extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saved(fn (Price $price) => $price->clearFrontendCache());
        static::deleted(fn (Price $price) => $price->clearFrontendCache());
    }

    // разрешённые для массового заполнения поля
    protected $fillable = [
        'service_id',
        'device_id',
        'price_from',
        'price_to',
        'units',
    ];

    /**
     * Связь с услугой (Service)
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Связь с устройством (Device)
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Связь с брендами (Brand)
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_price');
    }

    /**
     * Форматированный диапазон цены
     */
    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_from && $this->price_to) {
            return "{$this->price_from}-{$this->price_to} {$this->units}";
        }

        if ($this->price_from) {
            return "от {$this->price_from} {$this->units}";
        }

        return "уточняйте цену";
    }

    /**
     * Скоуп для фильтрации по устройству
     */
    public function scopeForDevice($query, $deviceId)
    {
        return $query->where('device_id', $deviceId);
    }

    /**
     * Скоуп для фильтрации по бренду
     */
    public function scopeForBrand($query, $brandId)
    {
        return $query->whereHas('brands', fn ($brandQuery) => $brandQuery->whereKey($brandId));
    }

    public function appliesToBrand(?int $brandId): bool
    {
        if (is_null($brandId)) {
            return $this->brands->isEmpty();
        }

        return $this->brands->contains('id', $brandId);
    }

    /**
     * Скоуп для конкретной услуги
     */
    public function scopeForService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }

    public function clearFrontendCache(): void
    {
        if (! $this->device_id) {
            return;
        }

        Cache::forget("device:{$this->device_id}:services");

        $brandIds = $this->relationLoaded('brands')
            ? $this->brands->pluck('id')
            : $this->brands()->pluck('brands.id');

        foreach ($brandIds as $brandId) {
            Cache::forget("device:{$this->device_id}:brand:{$brandId}:services");
        }
    }
}
