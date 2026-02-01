<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = config('catalog.brands', []);

        foreach ($brands as $brandName) {
            $slug = SlugService::createSlug(Brand::class, 'slug', $brandName);

            Brand::updateOrCreate(
                ['name' => $brandName], // ищем по имени
                [
                    'slug'      => $slug,
                    'is_active' => true,
                ]
            );
        }
    }
}
