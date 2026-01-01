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
            Brand::firstOrCreate(
                ['name' => $brand],
                ['description' => "Ремонт холодильников {$brand}"]
            );
        }
    }
}
