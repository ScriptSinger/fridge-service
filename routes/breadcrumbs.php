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
