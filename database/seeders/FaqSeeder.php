<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Legacy alias: general FAQ считаем FAQ для страницы home
        $pageFaqs = config('catalog.faqs.pages', []);
        $generalFaqs = config('catalog.faqs.general', []);
        if (! empty($generalFaqs)) {
            $pageFaqs['home'] = array_merge($pageFaqs['home'] ?? [], $generalFaqs);
        }

        // --- 2. FAQ по типу техники ---
        $deviceFaqs = config('catalog.faqs.devices', []);

        foreach ($deviceFaqs as $deviceType => $faqs) {
            $device = Device::where('type', $deviceType)->first();

            if (!$device) {
                $this->command->warn("Device '{$deviceType}' not found, skipping FAQ...");
                continue;
            }

            foreach ($faqs as $faqData) {
                Faq::updateOrCreate(
                    [
                        'question' => $faqData['question'],
                        'device_id' => $device->id,
                        'brand_id' => null,
                        'page_id' => null,
                    ],
                    array_merge($faqData, ['device_id' => $device->id, 'brand_id' => null, 'page_id' => null])
                );
            }
        }

        // --- 3. FAQ по бренду в рамках техники ---
        $brandFaqs = config('catalog.faqs.brands', []);

        foreach ($brandFaqs as $deviceType => $brands) {
            $device = Device::query()->where('type', $deviceType)->first();

            if (! $device) {
                $this->command?->warn("Device '{$deviceType}' not found, skipping brand FAQ...");
                continue;
            }

            foreach ($brands as $brandName => $faqs) {
                $brand = Brand::query()->where('name', $brandName)->first();

                if (! $brand) {
                    $this->command?->warn("Brand '{$brandName}' not found, skipping FAQ...");
                    continue;
                }

                foreach ($faqs as $faqData) {
                    Faq::updateOrCreate(
                        [
                            'question' => $faqData['question'],
                            'device_id' => $device->id,
                            'brand_id' => $brand->id,
                            'page_id' => null,
                        ],
                        array_merge($faqData, [
                            'device_id' => $device->id,
                            'brand_id' => $brand->id,
                            'page_id' => null,
                        ])
                    );
                }
            }
        }

        // --- 4. FAQ по странице ---
        foreach ($pageFaqs as $pageTypeKey => $faqs) {
            // ищем страницу через связанный PageType
            $page = Page::whereHas('pageType', fn($q) => $q->where('key', $pageTypeKey))->first();

            if (! $page) {
                $this->command?->warn("Page '{$pageTypeKey}' not found, skipping FAQ...");
                continue;
            }

            foreach ($faqs as $faqData) {
                Faq::updateOrCreate(
                    [
                        'question' => $faqData['question'],
                        'device_id' => null,
                        'brand_id' => null,
                        'page_id' => $page->id,
                    ],
                    array_merge($faqData, ['device_id' => null, 'brand_id' => null, 'page_id' => $page->id])
                );
            }
        }
    }
}
