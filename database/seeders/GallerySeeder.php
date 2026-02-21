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

        $mappedGalleries = $this->mediaMap()['galleries'] ?? [];

        foreach ($items as $index => $item) {
            if (empty($item['title'])) {
                $this->command?->warn("Gallery item #{$index} skipped (no title).");
                continue;
            }

            // --- Device ---
            $deviceId = null;
            if (! empty($item['device'])) {
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
            if (! empty($item['brand'])) {
                $brand = Brand::query()->where('name', $item['brand'])->first();

                if ($brand === null) {
                    $this->command?->warn("Gallery item #{$index}: brand '{$item['brand']}' not found.");
                } else {
                    $brandId = $brand->id;
                }
            }

            // --- Media map ---
            $mapped = $mappedGalleries[$item['title']] ?? [];
            $image = $mapped['image'] ?? null;
            $imageAlt = $mapped['image_alt'] ?? $item['title'];

            $gallery = Gallery::firstOrNew([
                'title' => $item['title'],
            ]);

            $gallery->fill([
                'description' => $item['description'] ?? null,
                'subtitle' => $item['subtitle'] ?? null,
                'device_id' => $deviceId,
                'brand_id' => $brandId,
                'page_id' => $item['page'] ?? null,
                'service_id' => $item['service'] ?? null,
                'image_alt' => $imageAlt,
                'sort_order' => $index + 1,
            ]);

            if ($image !== null) {
                $gallery->image = $image;
            }

            $gallery->save();
        }
    }
}
