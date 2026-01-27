<?php

namespace Database\Seeders;

use App\Models\Device;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $devices = [
            [
                'permalink'   => 'Ремонт холодильников',
                'type'        => 'Холодильник',
                'h1'          => 'Ремонт холодильников в Уфе',
                'subtitle'    => 'Выезд мастера в день обращения. Бесплатная диагностика при ремонте. Гарантия 6 месяцев.',
                'title'       => 'Ремонт холодильников на дому в Уфе — срочно | РемБытТехника',
                'description' => 'Срочный ремонт холодильников в Уфе с выездом мастера на дом. Бесплатная диагностика при ремонте и гарантия 6 месяцев. Обслуживаем все модели и марки.',
                'is_active'   => true,
            ],
            [
                'permalink'   => 'Ремонт стиральных машин',
                'type'        => 'Стиральная машина',
                'h1'          => 'Ремонт стиральных машин в Уфе',
                'subtitle'    => 'Выезд мастера в день обращения. Бесплатная диагностика при ремонте. Гарантия 6 месяцев.',
                'title'       => 'Ремонт стиральных машин на дому в Уфе — срочно | РемБытТехника',
                'description' => 'Срочный ремонт стиральных машин в Уфе с выездом мастера на дом. Бесплатная диагностика при ремонте и гарантия 6 месяцев. Обслуживаем все модели и бренды.',
                'is_active'   => true,
            ],
        ];

        foreach ($devices as $data) {
            $data['slug'] = SlugService::createSlug(Device::class, 'slug', $data['permalink']);
            Device::create($data);
        }
    }
}
