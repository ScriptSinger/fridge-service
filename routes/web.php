<?php

use App\Http\Controllers\DeviceBrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/appliances/{device:slug}', [DeviceController::class, 'show'])
    ->name('devices.show');

Route::get('/appliances/{device:slug}/{brand:slug}', [DeviceBrandController::class, 'show'])
    ->name('devices.brands.show');
