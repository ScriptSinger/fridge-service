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
        // Список проблем для каждого типа техники
        $problemsMap = [
            'Холодильник' => [
                'Холодильник не включается',
                'Холодильник не морозит',
                'Холодильник не холодит',
                'Холодильник шумит',
                'Холодильник течет',
                'Не работает компрессор холодильника',
                'Не закрывается дверь холодильника',
                'Не работает No Frost',
                'Перемораживает холодильник',
                'Холодильник выключается сам',
            ],
            'Стиральная машина' => [
                'Стиральная машина не включается',
                'Не набирается вода',
                'Не сливает воду',
                'Не крутится барабан',
                'Шумит при стирке',
                'Протекает бак',
                'Ошибка E01/E02',
                'Не работает дисплей',
                'Сильно вибрирует при отжиме',
            ],
        ];

        foreach ($problemsMap as $type => $problems) {
            $device = Device::where('type', $type)->first();

            if (!$device) {
                $this->command->warn("Device '{$type}' не найден. Проблемы для него не будут добавлены.");
                continue;
            }

            foreach ($problems as $problemTitle) {
                // Генерация slug вручную через SlugService
                $slug = SlugService::createSlug(Problem::class, 'slug', $problemTitle);

                Problem::firstOrCreate(
                    [
                        'title' => $problemTitle,
                        'device_id' => $device->id,
                    ],
                    [
                        'h1' => $problemTitle,
                        'content' => "Причины и способы устранения проблемы: {$problemTitle}",
                        'slug' => $slug,
                    ]
                );
            }
        }
    }
}
