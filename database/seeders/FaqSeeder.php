<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $generalFaqs = config('catalog.faqs.general', []);

        foreach ($generalFaqs as $faqData) {
            Faq::updateOrCreate(
                [
                    'question' => $faqData['question'],
                    'device_id' => null, // общие FAQ
                ],
                $faqData
            );
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
                    ],
                    array_merge($faqData, ['device_id' => $device->id])
                );
            }
        }

        $this->command->info('FAQ seeding completed!');
    }
}
