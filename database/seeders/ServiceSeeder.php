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
                'title'       => 'Ремонт холодильников',
                'type'       =>  'Холодильник',
                'h1'          => 'Ремонт холодильников на дому',
                'excerpt'     => 'Профессиональный ремонт холодильников на дому с выездом мастера. Гарантия качества и быстрые сроки выполнения работ.',
                'description' => 'Профессиональный ремонт холодильников на дому. Гарантия качества и быстрые сроки.',
                'content'     => 'Полное описание услуги ремонта холодильников: диагностика, замена деталей, профилактика и сервисное обслуживание.',
                'image'       => 'services/repair-fridge.jpg',
                'image_alt'   => 'Ремонт холодильников на дому',
                'is_active'   => true,
            ],
            [
                'title'       => 'Ремонт стиральных машин',
                'type'       =>  'Стиральная машина',
                'h1'          => 'Ремонт стиральных машин на дому',
                'excerpt'     => 'Качественный ремонт стиральных машин с выездом мастера на дом. Диагностика, настройка и гарантия.',
                'description' => 'Качественный ремонт стиральных машин с выездом мастера. Диагностика и гарантия.',
                'content'     => 'Подробное описание услуги ремонта стиральных машин: устранение протечек, ремонт двигателя, замена подшипников.',
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
