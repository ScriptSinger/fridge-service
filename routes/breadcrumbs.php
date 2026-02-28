<?php

use App\Models\Brand;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('devices.show', function (BreadcrumbTrail $trail, $device) {
    $trail->parent('home');
    $trail->push($device->permalink, route('devices.show', $device));
});

Breadcrumbs::for('devices.brands.show', function (BreadcrumbTrail $trail, Brand $brand) {
    $device = request()->route('device');
    $trail->parent('devices.show', $device);
    $trail->push($brand->name, route('devices.brands.show', [$device, $brand]));
});

Breadcrumbs::for('prices.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Цены', route('prices.index'));
});

Breadcrumbs::for('problems.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Неисправности', route('problems.index'));
});

Breadcrumbs::for('contacts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Контакты', route('contacts.index'));
});

Breadcrumbs::for('about.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('О компании', route('about.index'));
});

Breadcrumbs::for('reviews.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Отзывы', route('reviews.index'));
});

Breadcrumbs::for('gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Галерея', route('gallery.index'));
});

Breadcrumbs::for('legal.privacy-policy', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Политика конфиденциальности', route('legal.privacy-policy'));
});

Breadcrumbs::for('legal.personal-data-consent', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Согласие на обработку ПДн', route('legal.personal-data-consent'));
});
