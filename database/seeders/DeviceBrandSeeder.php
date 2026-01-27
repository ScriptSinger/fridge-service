<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Получаем сервисы
        $devices = Device::whereIn('type', [
            'Холодильник',
            'Стиральная машина'
        ])->get();

        // Получаем все бренды
        $brands = Brand::all();

        foreach ($devices as $device) {
            $pivotData = [];

            foreach ($brands as $brand) {
                $pivotData[$brand->id] = [
                    'h1'          => "Ремонт {$device->typeInCase('genitive')} {$brand->name}",
                    'subtitle'    => "Выезд мастера в день обращения для {$brand->name}",
                    'title'       => "Ремонт {$brand->name} — {$device->h1}",
                    'description' => "Обслуживаем все модели {$brand->name} {$device->typeInCase('genitive')}",
                ];
            }

            // Добавляет новые + обновляет существующие + не удаляет старые связи
            $device->brands()->syncWithoutDetaching($pivotData);
        }
    }
}
