<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

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
}
