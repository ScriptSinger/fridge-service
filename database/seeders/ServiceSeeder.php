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
                'title'       => 'Холодильник',
                'description' => 'Профессиональный ремонт холодильников на дому. Гарантия качества и быстрые сроки.',
                'image'       => 'services/repair-fridge.jpg',
                'image_alt'   => 'Ремонт холодильников на дому',
                'is_active'   => true,
            ],
            [
                'title'       => 'Стиральная машина',
                'description' => 'Качественный ремонт стиральных машин с выездом мастера. Диагностика и гарантия.',
                'image'       => 'services/repair-washing-machine.jpg',
                'image_alt'   => 'Ремонт стиральных машин на дому',
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
