<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Master;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificates = config('catalog.certificates', []);

        $mediaMapPath = resource_path('content/media-map.json');
        $mediaMap = File::exists($mediaMapPath)
            ? json_decode(File::get($mediaMapPath), true)
            : [];

        foreach ($certificates as $data) {
            $masterFullName = trim((string) ($data['master_full_name'] ?? ''));

            if ($masterFullName === '') {
                continue;
            }

            [$lastName, $firstName, $middleName] = $this->splitFullName($masterFullName);
            $master = $this->findMaster($lastName, $firstName, $middleName);

            if ($master === null) {
                continue;
            }

            $certificate = Certificate::updateOrCreate(
                [
                    'master_id' => $master->id,
                    'title' => $data['title'],
                ],
                [
                    'subtitle' => $data['subtitle'] ?? null,
                    'description' => $data['description'] ?? null,
                ]
            );

            if (isset($mediaMap['certificates'][$data['title']]['image'])) {
                $certificate->update([
                    'image' => $mediaMap['certificates'][$data['title']]['image'],
                ]);
            }
        }
    }

    private function splitFullName(string $fullName): array
    {
        $parts = array_values(preg_split('/\s+/u', $fullName, -1, PREG_SPLIT_NO_EMPTY));
        return [
            $parts[0] ?? '',
            $parts[1] ?? '',
            $parts[2] ?? '',
        ];
    }

    private function findMaster(string $lastName, string $firstName, string $middleName): ?Master
    {
        $query = Master::query();

        if ($lastName !== '') {
            $query->where('last_name', $lastName);
        }

        if ($firstName !== '') {
            $query->where('first_name', $firstName);
        }

        if ($middleName !== '') {
            $query->where('middle_name', $middleName);
        }

        $master = $query->first();

        if ($master !== null) {
            return $master;
        }

        if ($lastName !== '' && $firstName !== '') {
            return Master::query()
                ->where('last_name', $lastName)
                ->where('first_name', $firstName)
                ->first();
        }

        if ($firstName !== '') {
            return Master::query()
                ->where('first_name', $firstName)
                ->first();
        }

        return null;
    }
}
