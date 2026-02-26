<?php

use App\Http\Controllers\DeviceBrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/privacy-policy', [PageController::class, 'showLegal'])
    ->defaults('type', 'privacy-policy')
    ->name('legal.privacy-policy');
Route::get('/personal-data-consent', [PageController::class, 'showLegal'])
    ->defaults('type', 'personal-data-consent')
    ->name('legal.personal-data-consent');


Route::get('{device:slug}', [DeviceController::class, 'show'])
    ->name('devices.show');

Route::get('{device:slug}/{brand:slug}', [DeviceBrandController::class, 'show'])
    ->name('devices.brands.show');
