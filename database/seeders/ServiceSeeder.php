<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Service;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Берём список услуг из config
        $devicesServices = config('catalog.services.devices');

        foreach ($devicesServices as $deviceType => $services) {
            // Получаем устройство, которое должно уже существовать
            $device = Device::where('type', $deviceType)->first();

            // Если устройство не найдено — пропускаем или кидаем исключение
            if (!$device) {
                $this->command->warn("Device '{$deviceType}' not found, skipping services...");
                continue;
            }

            foreach ($services as $serviceName) {
                // Формируем массив данных для Service
                $data = [
                    'name' => $serviceName,
                    'device_id' => $device->id,
                ];

                // Генерация slug через SlugService
                $data['slug'] = SlugService::createSlug(Service::class, 'slug', $serviceName);

                // Создаём Service, если ещё нет
                Service::updateOrCreate(['slug' => $data['slug']], $data);
            }
        }
    }
}
