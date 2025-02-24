<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tabby\CheckoutController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\UserController;









Route::get('/cars', [CarController::class, 'index']);
Route::get('/luxury', [CarController::class, 'luxury_cars']);
Route::get('/mid', [CarController::class, 'mid_rang_cars']);
Route::get('/economy', [CarController::class, 'economy_cars']);
Route::get('/sports', [CarController::class, 'sport_cars']);
Route::get('/vans', [CarController::class, 'vans_cars']);




Route::post('/users', [UserController::class, 'store']);

Route::get('/users', function () {
    return response()->json(['message' => 'API is working']);
});




