<?php

namespace Database\Seeders;

use App\Models\Device;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Database\Seeders\Concerns\InteractsWithMediaMap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    use InteractsWithMediaMap;

    public function run(): void
    {
        $devices = config('catalog.devices', []);
        $mappedDevices = $this->mediaMap()['devices'] ?? [];

        foreach ($devices as $data) {
            // Генерируем slug, если его ещё нет
            $data['slug'] = SlugService::createSlug(Device::class, 'slug', $data['permalink']);
            $mapped = $mappedDevices[$data['permalink']] ?? [];

            if (! empty($mapped['image'])) {
                $data['image'] = $mapped['image'];
            }

            if (! empty($mapped['image_alt'])) {
                $data['image_alt'] = $mapped['image_alt'];
            }

            Device::updateOrCreate(
                ['permalink' => $data['permalink']], // проверяем по permalink
                $data
            );
        }
    }
}
