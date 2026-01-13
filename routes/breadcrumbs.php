<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/*
|--------------------------------------------------------------------------
| Breadcrumbs
|--------------------------------------------------------------------------
| Здесь мы определяем навигационные хлебные крошки для сайта.
| Пакет: diglactic/laravel-breadcrumbs
|
| Модели и маршруты подтягиваются автоматически через Route Model Binding.
*/

/**
 * Главная
 */
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

/**
 * Страница услуги: /services/{service}
 * Маршрут: services.show
 * Пример вывода: Главная → SMM-продвижение
 */
Breadcrumbs::for('services.show', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('home');
    $trail->push($service->title, route('services.show', $service));
});
