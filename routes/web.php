<?php

use App\Http\Controllers\DeviceBrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');


Route::get('{device:slug}', [DeviceController::class, 'show'])
    ->name('devices.show');

Route::get('{device:slug}/{brand:slug}', [DeviceBrandController::class, 'show'])
    ->name('devices.brands.show');
