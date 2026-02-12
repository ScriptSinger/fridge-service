<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AboutGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutPage = Page::where('type', 'about')->first();

        if (!$aboutPage) {
            $this->command?->warn("Page with type 'about' not found. Gallery seeding skipped.");
            return;
        }

        $images = Storage::disk('public')->files('pages');

        if (empty($images) && !empty($aboutPage->image)) {
            $images = [$aboutPage->image];
        }

        if (empty($images)) {
            $this->command?->warn("No images found in storage/public/pages and about page image is empty.");
            return;
        }

        $items = config('catalog.galleries.about', []);

        if (empty($items)) {
            $this->command?->warn("No gallery items found in config('catalog.galleries.about').");
            return;
        }

        foreach ($items as $index => $item) {
            if (empty($item['title'])) {
                $this->command?->warn("Gallery item #{$index} has no title. Skipped.");
                continue;
            }

            $image = $images[$index % count($images)];

            Gallery::updateOrCreate(
                [
                    'page_id' => $aboutPage->id,
                    'title' => $item['title'],
                ],
                [
                    'subtitle' => $item['subtitle'] ?? null,
                    'description' => $item['description'] ?? null,
                    'image' => $image,
                    'image_alt' => $item['title'],
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
