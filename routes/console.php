<?php

use App\Models\Brand;
use App\Models\Device;
use App\Models\Page;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('media:export-map', function () {
    $payload = [
        'devices' => Device::query()
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->get(['permalink', 'image', 'image_alt'])
            ->mapWithKeys(fn (Device $device) => [
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
            ->mapWithKeys(fn (Brand $brand) => [
                $brand->name => [
                    'image' => $brand->image,
                    'image_alt' => $brand->image_alt,
                ],
            ])
            ->all(),
        'pages' => Page::query()
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->get(['type', 'image', 'image_alt'])
            ->mapWithKeys(fn (Page $page) => [
                $page->type => [
                    'image' => $page->image,
                    'image_alt' => $page->image_alt,
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
})->purpose('Export DB image paths to resources/content/media-map.json');
