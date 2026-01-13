<?php

use App\Models\Brand;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('services.show', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('home');
    $trail->push($service->title, route('services.show', $service));
});

Breadcrumbs::for('brands.show', function (BreadcrumbTrail $trail, Brand $brand) {
    $service = request()->route('service');
    $trail->parent('services.show', $service);
    $trail->push($brand->name, route('brands.show', [$service, $brand]));
});
