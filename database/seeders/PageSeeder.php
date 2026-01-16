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
                'h1'          => 'Добро пожаловать на наш сайт',
                'subtitle'    => 'Все услуги в одном месте',
                'title'       => 'Главная',
                'description' => 'Описание главной страницы вашего сайта.',

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
