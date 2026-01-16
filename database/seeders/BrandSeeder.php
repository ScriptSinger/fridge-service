<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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

        foreach ($brands as $brand) {
            $data = [
                'name'        => $brand,
                'h1'          => "Ремонт холодильников {$brand}",
                'subtitle'    => 'Под ключ с гарантией качества',
                'title'       => "Ремонт холодильников {$brand}",
                'description' => "Профессиональный ремонт холодильников {$brand} на дому. Диагностика, выезд мастера и гарантия.",
                'image_alt'   => "Ремонт холодильников {$brand}",
                'is_active'   => true,
            ];

            Brand::firstOrCreate(
                ['name' => $brand],
                $data
            );
        }
    }
}
