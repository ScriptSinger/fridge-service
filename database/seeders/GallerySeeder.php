<?php

namespace Database\Seeders;

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
        $images = Storage::disk('public')->files('gallery');

        foreach ($items as $index => $item) {

            if (empty($item['title'])) {
                $this->command?->warn("Gallery item #{$index} skipped (no title).");
                continue;
            }

            $image = !empty($images)
                ? $images[$index % count($images)]
                : null;

            Gallery::updateOrCreate(
                [
                    'title' => $item['title'],
                ],
                [
                    'description' => $item['description'] ?? null,
                    'device_id'   => null,
                    'brand_id'    => null,
                    'page_id'     => null,
                    // service_id вообще не используется
                    'image'       => $image,
                    'image_alt'   => $item['title'],
                    'sort_order'  => $index + 1,
                ]
            );
        }
    }
}
