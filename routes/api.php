<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tabby\CheckoutController;
use App\Http\Controllers\Api\CarController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/cars', [CarController::class, 'index']);
Route::get('/luxury', [CarController::class, 'luxury_cars']);
Route::get('/mid', [CarController::class, 'mid_rang_cars']);
Route::get('/economy', [CarController::class, 'economy_cars']);
Route::get('/sports', [CarController::class, 'sport_cars']);



