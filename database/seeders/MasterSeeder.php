<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Master;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masters = config('catalog.masters', []);

        // Читаем media-map.json (если существует)
        $mediaMapPath = resource_path('content/media-map.json');
        $mediaMap = File::exists($mediaMapPath)
            ? json_decode(File::get($mediaMapPath), true)
            : [];

        foreach ($masters as $data) {

            $slug = SlugService::createSlug(
                Master::class,
                'slug',
                $data['name']
            );

            $photo = $mediaMap['master_photos'][$data['name']]['photo'] ?? null;

            $master = Master::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $data['name'],
                    'slug' => $slug,
                    'role' => $data['role'] ?? null,
                    'photo' => $photo,
                    'description' => $data['description'] ?? null,
                ]
            );

            foreach ($data['certificates'] ?? [] as $certificateData) {

                $certificate = Certificate::updateOrCreate(
                    [
                        'master_id' => $master->id,
                        'title' => $certificateData['title'],
                    ],
                    [
                        'subtitle' => $certificateData['subtitle'] ?? null,
                        'description' => $certificateData['description'] ?? null,
                    ]
                );

                // Подставляем изображение из media-map если есть
                if (isset($mediaMap['certificates'][$certificateData['title']]['image'])) {
                    $certificate->update([
                        'image' => $mediaMap['certificates'][$certificateData['title']]['image'],
                    ]);
                }
            }
        }
    }
}
