<?php

namespace Database\Seeders;

use App\Models\Problem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $problems = [
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
        ];

        foreach ($problems as $problem) {
            Problem::firstOrCreate(
                ['title' => $problem],
                [
                    'h1' => $problem,
                    'content' => "Причины и способы устранения проблемы: {$problem}",
                ]
            );
        }
    }
}
