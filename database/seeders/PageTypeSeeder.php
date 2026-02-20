<?php

namespace Database\Seeders;

use App\Models\PageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageTypes = [
            ['key' => 'home', 'name' => 'Главная', 'template' => 'pages.home', 'is_system' => true],
            ['key' => 'about', 'name' => 'О компании', 'template' => 'pages.about', 'is_system' => true],
            ['key' => 'contacts', 'name' => 'Контакты', 'template' => 'pages.contacts', 'is_system' => true],
            ['key' => 'prices', 'name' => 'Цены', 'template' => 'pages.prices', 'is_system' => true],
            ['key' => 'privacy-policy', 'name' => 'Политика конфиденциальности', 'template' => 'pages.legal', 'is_system' => true],
            ['key' => 'personal-data-consent', 'name' => 'Согласие на обработку данных', 'template' => 'pages.legal', 'is_system' => true],
        ];

        foreach ($pageTypes as $type) {
            PageType::updateOrCreate(['key' => $type['key']], $type);
        }
    }
}
