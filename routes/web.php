<?php


use App\Http\Controllers\HomeController;

use App\Http\Controllers\ServiceBrandController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services/{service:slug}', [ServiceController::class, 'show'])
    ->name('services.show');

Route::get('/services/{service:slug}/{brand:slug}', [ServiceBrandController::class, 'show'])
    ->name('services.brands.show');
