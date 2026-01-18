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
                'h1'          => "Ремонт холодильников {$brand} в Уфе",
                'subtitle'    => 'Выезд мастера на дом, диагностика бесплатно при ремонте, гарантия 6 месяцев',
                'title'       => "Ремонт холодильников {$brand} на дому — срочно | РемБытТехника",
                'description' => "Профессиональный ремонт холодильников {$brand} в Уфе с выездом мастера на дом. Бесплатная диагностика при ремонте, устранение любых поломок и гарантия 6 месяцев",
                'image_alt'   => "Ремонт холодильников {$brand}",
                'is_active'   => true,
            ];

            Brand::updateOrCreate(
                ['name' => $brand],
                $data
            );
        }
    }
}
