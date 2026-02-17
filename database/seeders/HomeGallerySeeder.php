<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HomeGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePage = Page::where('type', 'home')->first();

        if (!$homePage) {
            $this->command?->warn("Page with type 'home' not found. Gallery seeding skipped.");
            return;
        }

        $images = Storage::disk('public')->files('pages');

        if (empty($images) && !empty($homePage->image)) {
            $images = [$homePage->image];
        }

        if (empty($images)) {
            $this->command?->warn("No images found in storage/public/pages and home page image is empty.");
            return;
        }

        $items = config('catalog.galleries.home', []);

        if (empty($items)) {
            $this->command?->warn("No gallery items found in config('catalog.galleries.home').");
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
                    'page_id' => $homePage->id,
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
