<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\PageType;
use App\Models\Price;
use App\Models\Problem;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
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
                    $deviceIds = $devices->pluck('id')->all();

                    $problemMaxByDevice = Problem::query()
                        ->whereIn('device_id', $deviceIds)
                        ->where('is_active', true)
                        ->selectRaw('device_id, MAX(updated_at) as max_updated_at')
                        ->groupBy('device_id')
                        ->pluck('max_updated_at', 'device_id');

                    $galleryMaxByDevice = Gallery::query()
                        ->whereIn('device_id', $deviceIds)
                        ->selectRaw('device_id, MAX(updated_at) as max_updated_at')
                        ->groupBy('device_id')
                        ->pluck('max_updated_at', 'device_id');

                    $faqMaxByDevice = Faq::query()
                        ->whereIn('device_id', $deviceIds)
                        ->whereNull('brand_id')
                        ->where('is_active', true)
                        ->selectRaw('device_id, MAX(updated_at) as max_updated_at')
                        ->groupBy('device_id')
                        ->pluck('max_updated_at', 'device_id');

                    $serviceMaxByDevice = Service::query()
                        ->whereIn('device_id', $deviceIds)
                        ->where('is_active', true)
                        ->selectRaw('device_id, MAX(updated_at) as max_updated_at')
                        ->groupBy('device_id')
                        ->pluck('max_updated_at', 'device_id');

                    $priceMaxByDevice = Price::query()
                        ->join('services', 'prices.service_id', '=', 'services.id')
                        ->whereIn('services.device_id', $deviceIds)
                        ->selectRaw('services.device_id as device_id, MAX(prices.updated_at) as max_updated_at')
                        ->groupBy('services.device_id')
                        ->pluck('max_updated_at', 'device_id');

                    $brandIds = $devices
                        ->flatMap(fn($device) => $device->brands->pluck('id'))
                        ->unique()
                        ->values()
                        ->all();

                    $problemMaxByDeviceBrand = collect();
                    $galleryMaxByDeviceBrand = collect();
                    $faqMaxByDeviceBrand = collect();

                    if (! empty($brandIds)) {
                        $problemMaxByDeviceBrand = Problem::query()
                            ->join('brand_problem', 'brand_problem.problem_id', '=', 'problems.id')
                            ->whereIn('problems.device_id', $deviceIds)
                            ->whereIn('brand_problem.brand_id', $brandIds)
                            ->where('problems.is_active', true)
                            ->selectRaw('problems.device_id as device_id, brand_problem.brand_id as brand_id, MAX(problems.updated_at) as max_updated_at')
                            ->groupBy('problems.device_id', 'brand_problem.brand_id')
                            ->get()
                            ->mapWithKeys(fn($row) => ["{$row->device_id}:{$row->brand_id}" => $row->max_updated_at]);

                        $galleryMaxByDeviceBrand = Gallery::query()
                            ->whereIn('device_id', $deviceIds)
                            ->whereIn('brand_id', $brandIds)
                            ->selectRaw('device_id, brand_id, MAX(updated_at) as max_updated_at')
                            ->groupBy('device_id', 'brand_id')
                            ->get()
                            ->mapWithKeys(fn($row) => ["{$row->device_id}:{$row->brand_id}" => $row->max_updated_at]);

                        $faqMaxByDeviceBrand = Faq::query()
                            ->whereIn('device_id', $deviceIds)
                            ->whereIn('brand_id', $brandIds)
                            ->where('is_active', true)
                            ->selectRaw('device_id, brand_id, MAX(updated_at) as max_updated_at')
                            ->groupBy('device_id', 'brand_id')
                            ->get()
                            ->mapWithKeys(fn($row) => ["{$row->device_id}:{$row->brand_id}" => $row->max_updated_at]);
                    }

                    foreach ($devices as $device) {
                        $brandsMaxUpdatedAt = $device->brands->max('updated_at');
                        $pivotMaxUpdatedAt = $device->brands
                            ->map(fn($brand) => $brand->pivot?->updated_at)
                            ->filter()
                            ->max();

                        $deviceLastMod = $this->maxDate([
                            $device->updated_at,
                            $brandsMaxUpdatedAt,
                            $pivotMaxUpdatedAt,
                            $problemMaxByDevice[$device->id] ?? null,
                            $galleryMaxByDevice[$device->id] ?? null,
                            $faqMaxByDevice[$device->id] ?? null,
                            $serviceMaxByDevice[$device->id] ?? null,
                            $priceMaxByDevice[$device->id] ?? null,
                        ]);

                        $sitemap->add(
                            Url::create(route('devices.show', $device))
                                ->setLastModificationDate($deviceLastMod ?? $device->updated_at)
                                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                                ->setPriority(0.9)
                        );

                        foreach ($device->brands as $brand) {
                            $key = "{$device->id}:{$brand->id}";

                            $lastMod = $this->maxDate([
                                $device->updated_at,
                                $brand->updated_at,
                                $brand->pivot?->updated_at,
                                $problemMaxByDeviceBrand[$key] ?? null,
                                $galleryMaxByDeviceBrand[$key] ?? null,
                                $faqMaxByDeviceBrand[$key] ?? null,
                                $serviceMaxByDevice[$device->id] ?? null,
                                $priceMaxByDevice[$device->id] ?? null,
                            ]) ?? $device->updated_at;

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

    private function maxDate(array $dates): ?Carbon
    {
        $max = null;

        foreach ($dates as $date) {
            if (! $date) {
                continue;
            }

            $candidate = $date instanceof \DateTimeInterface
                ? Carbon::instance($date)
                : Carbon::parse($date);

            if (! $max || $candidate->gt($max)) {
                $max = $candidate;
            }
        }

        return $max;
    }
}
