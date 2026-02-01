<?php

namespace Database\Seeders;

use App\Models\Device;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $devices = config('catalog.devices', []);

        foreach ($devices as $data) {
            // Генерируем slug, если его ещё нет
            $data['slug'] = SlugService::createSlug(Device::class, 'slug', $data['permalink']);

            Device::updateOrCreate(
                ['permalink' => $data['permalink']], // проверяем по permalink
                $data
            );
        }
    }
}
