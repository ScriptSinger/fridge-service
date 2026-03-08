<?php

namespace Database\Seeders;

use App\Models\Master;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
            $lastName = trim((string) ($data['last_name'] ?? ''));
            $firstName = trim((string) ($data['first_name'] ?? ''));
            $middleName = trim((string) ($data['middle_name'] ?? ''));

            $fullName = trim(implode(' ', array_filter([
                $lastName !== '' ? $lastName : null,
                $firstName !== '' ? $firstName : null,
                $middleName !== '' ? $middleName : null,
            ])));

            $slug = SlugService::createSlug(
                Master::class,
                'slug',
                $fullName
            );

            $photo = $this->resolveMasterPhoto($mediaMap, $lastName, $firstName, $middleName, $fullName);

            $master = Master::updateOrCreate(
                ['slug' => $slug],
                [
                    'last_name' => $data['last_name'] ?? null,
                    'first_name' => $data['first_name'] ?? '',
                    'middle_name' => $data['middle_name'] ?? null,
                    'slug' => $slug,
                    'role' => $data['role'] ?? null,
                    'photo' => $photo,
                    'description' => $data['description'] ?? null,
                ]
            );
        }
    }

    private function resolveMasterPhoto(
        array $mediaMap,
        string $lastName,
        string $firstName,
        string $middleName,
        string $fullName
    ): ?string {
        $keys = array_filter([
            $fullName,
            trim("$firstName $middleName"),
            trim("$firstName $lastName"),
            trim("$lastName $firstName"),
            $firstName,
        ]);

        foreach ($keys as $key) {
            $photo = $mediaMap['master_photos'][$key]['photo'] ?? null;

            if (\is_string($photo) && $photo !== '') {
                return $photo;
            }
        }

        return null;
    }
}
