<?php

namespace Database\Seeders;

use App\Models\Brand;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Atlant',
            'LG',
            'Samsung',
            'Bosch',
            'Liebherr',
            'Indesit',
            'Haier',
            'Beko',
            'Miele',
            'Stinol',
            'Бирюса',
            'Ariston',
        ];

        foreach ($brands as $brandName) {
            $slug = SlugService::createSlug(Brand::class, 'slug', $brandName);

            Brand::updateOrCreate(
                ['name' => $brandName],
                [
                    'image_alt' => "Ремонт холодильников {$brandName}",
                    'is_active' => true,
                    'slug'      => $slug,
                ]
            );
        }
    }
}
