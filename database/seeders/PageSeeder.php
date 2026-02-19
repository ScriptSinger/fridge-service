<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'type' => 'home',
                'h1' => 'Главная страница',
                'subtitle' => 'Краткий подзаголовок для главной страницы.',
                'title' => 'Главная | РемБытТехника',
                'description' => 'Краткое описание для главной страницы.',
                'content' => '<p>Контент главной страницы.</p>',
                'is_active' => true,
            ],
            [
                'type' => 'about',
                'h1' => 'О компании',
                'subtitle' => 'Краткий подзаголовок для страницы о компании.',
                'title' => 'О компании | РемБытТехника',
                'description' => 'Краткое описание для страницы о компании.',
                'content' => '<p>Контент страницы о компании.</p>',
                'is_active' => true,
            ],
            [
                'type' => 'contacts',
                'h1' => 'Контакты',
                'subtitle' => 'Краткий подзаголовок для страницы контактов.',
                'title' => 'Контакты | РемБытТехника',
                'description' => 'Краткое описание для страницы контактов.',
                'content' => '<p>Контент страницы контактов.</p>',
                'is_active' => true,
            ],
            [
                'type' => 'privacy-policy',
                'h1' => 'Политика конфиденциальности',
                'subtitle' => 'Правила обработки и защиты персональных данных.',
                'title' => 'Политика конфиденциальности | РемБытТехника',
                'description' => 'Краткое описание страницы политики конфиденциальности.',
                'content' => $this->loadHtmlContent('privacy-policy.html'),
                'is_active' => true,
            ],
            [
                'type' => 'personal-data-consent',
                'h1' => 'Согласие на обработку персональных данных',
                'subtitle' => 'Согласие пользователя на обработку данных.',
                'title' => 'Согласие на обработку персональных данных | РемБытТехника',
                'description' => 'Краткое описание страницы согласия на обработку персональных данных.',
                'content' => $this->loadHtmlContent('personal-data-consent.html'),
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['type' => $page['type']], $page);
        }
    }

    private function loadHtmlContent(string $filename): string
    {
        $path = resource_path("content/{$filename}");

        return File::exists($path) ? File::get($path) : '';
    }
}
