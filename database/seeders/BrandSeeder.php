<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Database\Seeders\Concerns\InteractsWithMediaMap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    use InteractsWithMediaMap;

    public function run(): void
    {
        $brands = config('catalog.brands', []);
        $mappedBrands = $this->mediaMap()['brands'] ?? [];

        foreach ($brands as $brandName) {
            $slug = SlugService::createSlug(Brand::class, 'slug', $brandName);
            $mapped = $mappedBrands[$brandName] ?? [];

            Brand::updateOrCreate(
                ['name' => $brandName], // ищем по имени
                [
                    'slug'      => $slug,
                    'image'     => $mapped['image'] ?? null,
                    'image_alt' => $mapped['image_alt'] ?? null,
                    'is_active' => true,
                ]
            );
        }
    }
}
