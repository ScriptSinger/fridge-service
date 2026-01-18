<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Получаем сервисы
        $services = Service::whereIn('type', [
            'Холодильник',
            'Стиральная машина'
        ])->get();

        // Получаем все бренды
        $brands = Brand::all();

        foreach ($services as $service) {
            $pivotData = [];

            foreach ($brands as $brand) {
                $pivotData[$brand->id] = [
                    'h1'          => "Ремонт {$service->typeInCase('genitive')} {$brand->name}",
                    'subtitle'    => "Выезд мастера в день обращения для {$brand->name}",
                    'title'       => "Ремонт {$brand->name} — {$service->h1}",
                    'description' => "Обслуживаем все модели {$brand->name} {$service->typeInCase('genitive')}",
                ];
            }

            // Добавляет новые + обновляет существующие + не удаляет старые связи
            $service->brands()->syncWithoutDetaching($pivotData);
        }
    }
}
