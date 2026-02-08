<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Problem;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    public function run(): void
    {
        $problemsMap = config('catalog.problems', []);

        foreach ($problemsMap as $type => $problems) {
            $device = Device::where('type', $type)->first();

            if (!$device) {
                $this->command->warn("Device '{$type}' не найден. Проблемы для него не будут добавлены.");
                continue;
            }

            foreach ($problems as $problem) {
                $problemTitle = $problem['title'] ?? null;
                $problemContent = $problem['content'] ?? null;

                if (!$problemTitle || !$problemContent) {
                    $this->command->warn("Некорректная запись проблемы для '{$type}'.");
                    continue;
                }
                // Генерация slug вручную через SlugService
                $slug = SlugService::createSlug(Problem::class, 'slug', $problemTitle);

                Problem::updateOrCreate(
                    [
                        'title' => $problemTitle,
                        'device_id' => $device->id,
                    ],
                    [
                        'h1' => $problemTitle,
                        'content' => $problemContent,
                        'slug' => $slug,
                    ]
                );
            }
        }
    }
}
