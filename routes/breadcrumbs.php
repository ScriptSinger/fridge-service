<?php

use App\Models\Brand;
use App\Models\ErrorCode;
use App\Models\Gallery;
use App\Models\Problem;
use App\Models\Service;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Str;


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

Breadcrumbs::for('services.show', function (BreadcrumbTrail $trail, Service $service) {
    $device = request()->route('device');
    $trail->parent('devices.show', $device);
    $trail->push($service->name, route('services.show', [$device, $service->slug]));
});

Breadcrumbs::for('problems.show', function (BreadcrumbTrail $trail, Problem $problem) {
    $device = request()->route('device');
    $trail->parent('devices.show', $device);
    $trail->push($problem->title, route('problems.show', [$device, $problem->slug]));
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

Breadcrumbs::for('gallery.show', function (BreadcrumbTrail $trail, Gallery $gallery) {
    if ($gallery->problem && $gallery->problem->is_active && $gallery->problem->device) {
        $trail->parent('devices.show', $gallery->problem->device);
        $trail->push($gallery->problem->title, route('problems.show', [$gallery->problem->device, $gallery->problem->slug]));
    } elseif ($gallery->errorCode && $gallery->errorCode->is_active && $gallery->errorCode->device) {
        $errorCode = $gallery->errorCode;

        if ($errorCode->brand) {
            $trail->parent('devices.show', $errorCode->device);
            $trail->push($errorCode->brand->name, route('devices.brands.show', [$errorCode->device, $errorCode->brand]));
        } else {
            $trail->parent('devices.show', $errorCode->device);
        }

        $trail->push($errorCode->code ? 'Ошибка '.$errorCode->code : $errorCode->title, route('error-codes.show', [$errorCode->device, $errorCode->slug]));
    } elseif ($gallery->brand && $gallery->device) {
        $trail->parent('devices.show', $gallery->device);
        $trail->push($gallery->brand->name, route('devices.brands.show', [$gallery->device, $gallery->brand]));
    } elseif ($gallery->service && $gallery->service->device) {
        $trail->parent('devices.show', $gallery->service->device);
        $trail->push($gallery->service->name, route('services.show', [$gallery->service->device, $gallery->service->slug]));
    } elseif ($gallery->device) {
        $trail->parent('devices.show', $gallery->device);
    } else {
        $trail->parent('gallery.index');
    }

    $trail->push($gallery->title ? Str::limit($gallery->title, 40, preserveWords: true) : 'Выполненный ремонт', route('gallery.show', $gallery));
});

Breadcrumbs::for('error-codes.show', function (BreadcrumbTrail $trail, ErrorCode $errorCode) {
    $device = request()->route('device');

    if ($errorCode->brand) {
        $trail->parent('devices.brands.show', $errorCode->brand);
    } else {
        $trail->parent('devices.show', $device);
    }

    $trail->push($errorCode->code ? 'Ошибка '.$errorCode->code : $errorCode->title, route('error-codes.show', [$device, $errorCode->slug]));
});

Breadcrumbs::for('legal.privacy-policy', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Политика конфиденциальности', route('legal.privacy-policy'));
});

Breadcrumbs::for('legal.personal-data-consent', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Согласие на обработку ПДн', route('legal.personal-data-consent'));
});
