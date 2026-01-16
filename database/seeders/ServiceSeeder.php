<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'type'        => 'Холодильник',
                'h1'          => 'Ремонт холодильников',
                'subtitle'    => 'Под ключ с гарантией качества',
                'title'       => 'Ремонт холодильников',
                'description' => 'Профессиональный ремонт холодильников всех марок на дому. Гарантия, выезд мастера, цены от 500 ₽.',
                'is_active'   => true,
            ],
            [
                'type'        => 'Стиральная машина',
                'h1'          => 'Ремонт стиральных машин',
                'subtitle'    => 'Под ключ с гарантией качества',
                'title'       => 'Ремонт стиральных машин',
                'description' => 'Качественный ремонт стиральных машин с выездом мастера. Диагностика и гарантия.',
                'is_active'   => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
