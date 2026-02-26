<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Review;
use Database\Seeders\Concerns\InteractsWithMediaMap;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    use InteractsWithMediaMap;

    public function run(): void
    {
        $reviews = config('catalog.reviews', []);
        $mapped = $this->mediaMap()['reviews'] ?? [];

        foreach ($reviews as $data) {
            $key = $data['name'] . '|' . ($data['title'] ?? '');

            // Аватар из media-map
            if (!empty($mapped[$key]['avatar'])) {
                $data['avatar'] = $mapped[$key]['avatar'];
            }

            // Подставляем device_id по типу техники, если указан
            if (!empty($data['device_type'])) {
                $device = Device::where('type', $data['device_type'])->first();
                if ($device) {
                    $data['device_id'] = $device->id;
                }
                unset($data['device_type']);
            }

            $data['is_published'] = $data['is_published'] ?? true;
            $data['is_featured'] = $data['is_featured'] ?? false;

            Review::updateOrCreate(
                ['name' => $data['name'], 'title' => $data['title']],
                $data
            );
        }
    }
}
