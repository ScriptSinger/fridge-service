<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\PageType;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap.xml with static, device and brand pages';

    public function handle(): int
    {
        $sitemap = Sitemap::create();

        $staticRoutes = [
            'home',
            'prices.index',
            'contacts.index',
            'about.index',
            'reviews.index',
            'gallery.index',
            'legal.privacy-policy',
            'legal.personal-data-consent',
        ];

        foreach ($staticRoutes as $routeName) {
            $sitemap->add(Url::create(route($routeName)));
        }

        try {
            Device::query()
                ->where('is_active', true)
                ->whereNotNull('slug')
                ->select(['id', 'slug', 'updated_at'])
                ->with([
                    'brands' => fn($query) => $query
                        ->where('is_active', true)
                        ->whereNotNull('slug')
                        ->select(['brands.id', 'brands.slug', 'brands.updated_at']),
                ])
                ->orderBy('id')
                ->chunk(200, function ($devices) use ($sitemap) {
                    foreach ($devices as $device) {
                        $sitemap->add(
                            Url::create(route('devices.show', $device))
                                ->setLastModificationDate($device->updated_at)
                                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                                ->setPriority(0.9)
                        );

                        foreach ($device->brands as $brand) {
                            $lastMod = $device->updated_at->gt($brand->updated_at)
                                ? $device->updated_at
                                : $brand->updated_at;

                            $sitemap->add(
                                Url::create(route('devices.brands.show', [$device, $brand]))
                                    ->setLastModificationDate($lastMod)
                                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                                    ->setPriority(0.8)
                            );
                        }
                    }
                });

            PageType::query()
                ->with('page:id,page_type_id,updated_at')
                ->get(['id', 'key'])
                ->each(function (PageType $type) use ($sitemap) {
                    if (! $type->page) {
                        return;
                    }

                    $routeName = match ($type->key) {
                        'home' => 'home',
                        'prices' => 'prices.index',
                        'contacts' => 'contacts.index',
                        'about' => 'about.index',
                        'privacy-policy' => 'legal.privacy-policy',
                        'personal-data-consent' => 'legal.personal-data-consent',
                        default => null,
                    };

                    if (! $routeName) {
                        return;
                    }

                    $url = route($routeName);
                    $tag = $sitemap->getUrl($url);

                    if ($tag) {
                        $tag->setLastModificationDate($type->page->updated_at);
                    }
                });
        } catch (\Throwable $e) {
            $this->warn('Database is unavailable. Generated sitemap with static routes only.');
        }

        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info("Sitemap generated: {$path}");

        return self::SUCCESS;
    }
}
