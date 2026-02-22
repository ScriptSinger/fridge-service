<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Gallery;
use Database\Seeders\Concerns\InteractsWithMediaMap;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    use InteractsWithMediaMap;

    public function run(): void
    {
        $items = config('catalog.galleries.items', []);

        if (empty($items)) {
            $this->command?->warn('Gallery config is empty.');
            return;
        }

        // --- Загружаем медиакарту ---
        $mappedGalleries = $this->mediaMap()['gallery'] ?? [];

        foreach ($items as $index => $item) {
            if (empty($item['title'])) {
                $this->command?->warn("Gallery item #{$index} skipped (no title).");
                continue;
            }

            // --- Device ---
            $deviceId = null;
            if (!empty($item['device'])) {
                $device = Device::query()
                    ->where('type', $item['device'])
                    ->orWhere('permalink', $item['device'])
                    ->first();

                if ($device === null) {
                    $this->command?->warn("Gallery item #{$index}: device '{$item['device']}' not found.");
                } else {
                    $deviceId = $device->id;
                }
            }

            // --- Brand ---
            $brandId = null;
            if (!empty($item['brand'])) {
                $brand = Brand::query()->where('name', $item['brand'])->first();

                if ($brand === null) {
                    $this->command?->warn("Gallery item #{$index}: brand '{$item['brand']}' not found.");
                } else {
                    $brandId = $brand->id;
                }
            }

            // --- Данные для updateOrCreate ---
            $data = [
                'title' => $item['title'],
                'description' => $item['description'] ?? null,
                'subtitle' => $item['subtitle'] ?? null,
                'device_id' => $deviceId,
                'brand_id' => $brandId,
                'page_id' => $item['page'] ?? null,
                'service_id' => $item['service'] ?? null,
                'image_alt' => $item['title'], // дефолт alt
                'sort_order' => $index + 1,
            ];

            // --- Создаём или обновляем запись ---
            $gallery = Gallery::updateOrCreate(
                [
                    'device_id' => $deviceId,
                    'brand_id' => $brandId,
                    'subtitle' => $item['subtitle'] ?? null,
                ],
                $data
            );

            // --- Назначаем картинку из медиакарты по id ---
            $mapped = $mappedGalleries[$gallery->id] ?? null;
            if ($mapped) {
                $gallery->image = $mapped['image'];
                $gallery->image_alt = $mapped['image_alt'] ?? $gallery->image_alt;
                $gallery->save();
            }
        }
    }
}
