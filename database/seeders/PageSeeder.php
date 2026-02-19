<?php

namespace Database\Seeders;

use App\Models\Page;
use Database\Seeders\Concerns\InteractsWithMediaMap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    use InteractsWithMediaMap;

    public function run(): void
    {
        $mappedPages = $this->mediaMap()['pages'] ?? [];

        $pages = [
            [
                'type' => 'home',
                'h1' => 'Ремонт бытовой техники в Уфе',
                'subtitle' => 'Выезд мастера в день обращения. Бесплатная диагностика, гарантия на работу и запчасти',
                'title' => 'Ремонт крупной бытовой техники на дому в Уфе | РемБытТехника',
                'description' => 'Профессиональный ремонт крупной бытовой техники на дому: стиральные машины, холодильники и посудомоечные машины. Бесплатная диагностика, гарантия на работу и запчасти, скидки при заказе онлайн',
                'content' => '',
                'is_active' => true,
            ],
            [
                'type' => 'about',
                'h1' => 'О компании',
                'subtitle' => 'РемБытТехника — местная компания с историей, командой мастеров и многолетним опытом работы в Уфе',
                'title' => 'О компании | РемБытТехника',
                'description' => 'РемБытТехника — местная компания из Уфы, работающая с 2008 года. Постоянная команда мастеров и многолетний опыт ремонта бытовой техники',
                'content' => '',
                'is_active' => true,
            ],
            [
                'type' => 'contacts',
                'h1' => 'Контакты',
                'subtitle' => 'Мы всегда на связи',
                'title' => 'Контакты | РемБытТехника',
                'description' => 'Контактная информация, карта проезда и форма обратной связи',
                'content' => '',
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
            $mapped = $mappedPages[$page['type']] ?? [];

            if (! empty($mapped['image'])) {
                $page['image'] = $mapped['image'];
            }

            if (! empty($mapped['image_alt'])) {
                $page['image_alt'] = $mapped['image_alt'];
            }

            Page::updateOrCreate(['type' => $page['type']], $page);
        }
    }

    private function loadHtmlContent(string $filename): string
    {
        $path = resource_path("content/{$filename}");

        return File::exists($path) ? File::get($path) : '';
    }
}
