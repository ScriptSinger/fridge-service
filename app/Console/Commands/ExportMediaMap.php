<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Certificate;
use App\Models\Device;
use App\Models\Gallery;
use App\Models\Master;
use App\Models\Page;
use App\Models\Review;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportMediaMap extends Command
{
    protected $signature = 'media:export-map';

    protected $description = 'Export DB media paths (including gallery and reviews) to resources/content/media-map.json';

    public function handle(): int
    {
        $payload = [
            'devices' => Device::query()
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->get(['permalink', 'image', 'image_alt'])
                ->mapWithKeys(fn(Device $device) => [
                    $device->permalink => [
                        'image' => $device->image,
                        'image_alt' => $device->image_alt,
                    ],
                ])
                ->all(),

            'brands' => Brand::query()
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->get(['name', 'image', 'image_alt'])
                ->mapWithKeys(fn(Brand $brand) => [
                    $brand->name => [
                        'image' => $brand->image,
                        'image_alt' => $brand->image_alt,
                    ],
                ])
                ->all(),

            'pages' => Page::query()
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->with('pageType:id,key')
                ->get()
                ->filter(fn($page) => $page->pageType !== null)
                ->mapWithKeys(fn(Page $page) => [
                    $page->pageType->key => [
                        'image' => $page->image,
                        'image_alt' => $page->image_alt,
                    ],
                ])
                ->all(),

            'gallery' => Gallery::query()
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->get(['id', 'image', 'image_alt'])
                ->mapWithKeys(fn($item) => [
                    $item->id => [
                        'image' => $item->image,
                        'image_alt' => $item->image_alt,
                    ],
                ])
                ->all(),

            'master_photos' => Master::query()
                ->whereNotNull('photo')
                ->where('photo', '!=', '')
                ->get(['name', 'photo'])
                ->mapWithKeys(fn(Master $master) => [
                    $master->name => [
                        'photo' => $master->photo,
                    ],
                ])
                ->all(),

            'certificates' => Certificate::query()
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->get(['title', 'image'])
                ->mapWithKeys(fn(Certificate $certificate) => [
                    $certificate->title => [
                        'image' => $certificate->image,
                    ],
                ])
                ->all(),

            'reviews' => Review::query()
                ->get(['name', 'title', 'avatar', 'image'])
                ->filter(fn(Review $review) => filled(trim((string) $review->avatar)) || filled(trim((string) $review->image)))
                ->mapWithKeys(fn(Review $review) => [
                    $review->name . '|' . ((string) $review->title) => [
                        'avatar' => filled(trim((string) $review->avatar)) ? $review->avatar : null,
                        'image' => filled(trim((string) $review->image)) ? $review->image : null,
                    ],
                ])
                ->all(),
        ];

        $path = resource_path('content/media-map.json');
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->info("Media map exported to {$path}");
        $this->line('devices: ' . count($payload['devices']));
        $this->line('brands: ' . count($payload['brands']));
        $this->line('pages: ' . count($payload['pages']));
        $this->line('gallery: ' . count($payload['gallery']));
        $this->line('reviews: ' . count($payload['reviews']));

        return self::SUCCESS;
    }
}
