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
        Service::firstOrCreate(
            ['title' => 'Ремонт холодильников'],
            [
                'h1' => 'Ремонт холодильников на дому',
                'excerpt' => 'Быстрое и качественное решение проблем с холодильником.',
                'description' => 'Профессиональный ремонт холодильников на дому. Гарантия качества и быстрые сроки.',
                'content' => 'Полное описание услуги ремонта холодильников: диагностика, замена деталей, профилактика и сервисное обслуживание.',
                'image' => 'services/repair-fridge.jpg',
                'image_alt' => 'Ремонт холодильников на дому',
                'is_active' => true,
            ]
        );
    }
}
