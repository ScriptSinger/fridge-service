<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = config('catalog.galleries.items', []);

        if (empty($items)) {
            $this->command?->warn('Gallery config is empty.');
            return;
        }

        // Берём изображения из папки public/gallery
        $images = Storage::disk(config('filesystems.media'))->files('gallery');

        foreach ($items as $index => $item) {
            if (empty($item['title'])) {
                $this->command?->warn("Gallery item #{$index} skipped (no title).");
                continue;
            }

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

            $brandId = null;
            if (! empty($item['brand'])) {
                $brand = Brand::query()
                    ->where('name', $item['brand'])
                    ->first();

                if ($brand === null) {
                    $this->command?->warn("Gallery item #{$index}: brand '{$item['brand']}' not found.");
                } else {
                    $brandId = $brand->id;
                }
            }

            $image = ! empty($images)
                ? $images[$index % count($images)]
                : null;

            $gallery = Gallery::firstOrNew([
                'title' => $item['title'],
            ]);

            if ($image === null && empty($gallery->image)) {
                $this->command?->warn("Gallery item #{$index} skipped (no image found on disk and no existing image in DB).");
                continue;
            }

            $gallery->fill([
                'description' => $item['description'] ?? null,
                'subtitle' => $item['subtitle'] ?? null,
                'device_id' => $deviceId,
                'brand_id' => $brandId,
                'page_id' => $item['page'] ?? null,
                'service_id' => $item['service'] ?? null,
                'image_alt' => $item['title'],
                'sort_order' => $index + 1,
            ]);

            if ($image !== null) {
                $gallery->image = $image;
            }

            $gallery->save();
        }
    }
}
