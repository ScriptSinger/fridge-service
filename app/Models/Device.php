<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Device extends Model
{
    use Sluggable;
    use HasImageUrl;

    protected static function booted(): void
    {
        static::saved(fn (Device $device) => $device->clearActiveCache());
        static::deleted(fn (Device $device) => $device->clearActiveCache());
    }

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
        return $this->belongsToMany(Brand::class)
            ->withPivot(['h1', 'subtitle', 'title', 'description', 'updated_at']);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class)->where('is_active', true);
    }

    public function services()
    {
        return $this->hasMany(Service::class)->where('is_active', true);
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
     * Активные устройства, закэшированные под общим ключом для всех потребителей
     * (главная страница, навигация/футер), чтобы избежать рассинхронизации кэша.
     */
    public static function activeCached(): Collection
    {
        return Cache::remember('devices:active', now()->addMinutes(20), function () {
            return static::where('is_active', true)->orderBy('type')->get();
        });
    }

    public function clearActiveCache(): void
    {
        Cache::forget('devices:active');
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

        if (isset($map[$type][$case])) {
            return $map[$type][$case];
        }

        if ($case === 'genitive_plural' && ! empty($this->permalink)) {
            $normalized = Str::of($this->permalink)
                ->lower()
                ->replaceStart('ремонт ', '')
                ->trim()
                ->value();

            if ($normalized !== '') {
                return $normalized;
            }
        }

        return Str::lower($type);
    }
}
