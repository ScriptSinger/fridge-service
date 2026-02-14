<?php

use App\Http\Controllers\DeviceBrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


Route::get('{device:slug}', [DeviceController::class, 'show'])
    ->name('devices.show');

Route::get('{device:slug}/{brand:slug}', [DeviceBrandController::class, 'show'])
    ->name('devices.brands.show');
