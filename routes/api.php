<?php

use App\Http\Controllers\Api\ContactClickController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/leads', [LeadController::class, 'store'])
    ->middleware('throttle:10,1');

Route::post('/contact-clicks', [ContactClickController::class, 'store'])
    ->middleware('throttle:30,1');
