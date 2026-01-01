<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\ErrorCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ErrorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lg = Brand::where('name', 'lg')->first();

        if (! $lg) {
            return;
        }

        $errors = [
            [
                'code' => 'E3',
                'title' => 'Ошибка E3 холодильника LG',
                'description' => 'Ошибка E3 указывает на проблему с датчиком температуры.'
            ],
            [
                'code' => 'E1',
                'title' => 'Ошибка E1 холодильника LG',
                'description' => 'Ошибка E1 связана с неисправностью системы охлаждения.'
            ],
        ];

        foreach ($errors as $error) {
            ErrorCode::firstOrCreate(
                [
                    'brand_id' => $lg->id,
                    'code' => $error['code'],
                ],
                [
                    'title' => $error['title'],
                    'description' => $error['description'],
                ]
            );
        }
    }
}
