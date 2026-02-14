<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Price;
use App\Models\Service;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $devicesServices = config('catalog.services.devices');

        foreach ($devicesServices as $deviceType => $services) {
            $device = Device::where('type', $deviceType)->first();

            if (!$device) {
                $this->command->warn("Device '{$deviceType}' not found, skipping services...");
                continue;
            }

            foreach ($services as $serviceConfig) {
                $serviceName = is_array($serviceConfig)
                    ? ($serviceConfig['name'] ?? null)
                    : $serviceConfig;

                if (!$serviceName) {
                    $this->command?->warn("Invalid service config for device '{$deviceType}', skipping...");
                    continue;
                }

                $service = Service::firstOrNew([
                    'device_id' => $device->id,
                    'name' => $serviceName,
                ]);

                if (!$service->exists || empty($service->slug)) {
                    $service->slug = SlugService::createSlug(Service::class, 'slug', $serviceName);
                }

                $service->device_id = $device->id;
                $service->name = $serviceName;
                $service->save();

                if (is_array($serviceConfig) && (
                    array_key_exists('price_from', $serviceConfig) || array_key_exists('price_to', $serviceConfig)
                )) {
                    Price::updateOrCreate(
                        [
                            'service_id' => $service->id,
                            'device_id' => $device->id,
                            'brand_id' => null,
                        ],
                        [
                            'price_from' => $serviceConfig['price_from'] ?? null,
                            'price_to' => $serviceConfig['price_to'] ?? null,
                            'units' => $serviceConfig['units'] ?? '₽',
                        ]
                    );
                }
            }
        }
    }
}
