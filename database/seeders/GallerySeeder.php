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

        // Загружаем медиакарту
        $mappedGalleries = $this->mediaMap()['gallery'] ?? [];

        foreach ($items as $index => $item) {
            if (empty($item['title'])) {
                $this->command?->warn("Gallery item #{$index} skipped (no title).");
                continue;
            }

            // --- Получаем device_id ---
            $deviceId = $this->getDeviceId($item['device'], $index);

            // --- Получаем brand_id ---
            $brandId = $this->getBrandId($item['brand'], $index);

            // --- Подготавливаем данные для создания ---
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

            // --- Создаем новую запись (каждый элемент уникален) ---
            $gallery = Gallery::create($data);

            // --- Назначаем картинку из медиакарты по ID ---
            $mapped = $mappedGalleries[$gallery->id] ?? null;
            if ($mapped) {
                $gallery->image = $mapped['image'];
                $gallery->image_alt = $mapped['image_alt'] ?? $gallery->image_alt;
                $gallery->save();
            }
        }
    }

    private function getDeviceId(?string $deviceName, int $index): ?int
    {
        if (empty($deviceName)) {
            return null;
        }

        $device = Device::query()
            ->where('type', $deviceName)
            ->orWhere('permalink', $deviceName)
            ->first();

        if (!$device) {
            $this->command?->warn("Gallery item #{$index}: device '{$deviceName}' not found.");
            return null;
        }

        return $device->id;
    }

    private function getBrandId(?string $brandName, int $index): ?int
    {
        if (empty($brandName)) {
            return null;
        }

        $brand = Brand::query()->where('name', $brandName)->first();

        if (!$brand) {
            $this->command?->warn("Gallery item #{$index}: brand '{$brandName}' not found.");
            return null;
        }

        return $brand->id;
    }
}
