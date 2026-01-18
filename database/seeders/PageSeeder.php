<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'type'        => 'home', // ключ для поиска
                'h1'          => 'Ремонт бытовой техники в Уфе',
                'subtitle'    => 'Выезд мастера в день обращения. Бесплатная диагностика, гарантия на работу и запчасти',
                'title'       => 'Ремонт бытовой техники на дому в Уфе | РемБытТехника',
                'description' => 'Профессиональный ремонт крупной бытовой техники на дому: стиральные машины, холодильники и посудомоечные машины. Бесплатная диагностика, гарантия на работу и запчасти, скидки при заказе онлайн',

                'is_active'   => true,
            ],
            [
                'type'        => 'about', // ключ для поиска
                'h1'          => 'О нашей компании',
                'subtitle'    => 'Мы ценим качество и клиентов',
                'title'       => 'О нас',
                'description' => 'Страница с информацией о компании, нашей миссии и истории.',

                'is_active'   => true,
            ],
            [
                'type'        => 'contacts', // ключ для поиска
                'h1'          => 'Свяжитесь с нами',
                'subtitle'    => 'Мы всегда на связи',
                'title'       => 'Контакты',
                'description' => 'Контактная информация, карта проезда и форма обратной связи.',

                'is_active'   => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['type' => $page['type']], // ищем по ключу
                $page
            );
        }
    }
}
