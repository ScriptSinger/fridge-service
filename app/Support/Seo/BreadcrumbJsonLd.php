<?php

namespace App\Support\Seo;

class BreadcrumbJsonLd
{
    /**
     * Собрать JSON-LD BreadcrumbList для набора хлебных крошек (diglactic/laravel-breadcrumbs).
     * Строится в PHP, а не в blade-шаблоне, т.к. Blade-компилятор путает '@type'/'@context'
     * внутри @php-блока с директивами (см. Faq::jsonLdFor()).
     */
    public static function make(iterable $breadcrumbs): string
    {
        $items = collect($breadcrumbs)
            ->values()
            ->map(fn ($breadcrumb, $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb->title,
                'item' => $breadcrumb->url,
            ])
            ->all();

        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
