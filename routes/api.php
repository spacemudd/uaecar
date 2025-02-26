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
Route::post('/check-phone', [UserController::class, 'checkPhoneNumber']);



Route::get('/reserve-car', [CarController::class, 'authenticate']);

Route::post('/get-vehicle-id', [CarController::class, 'getVehicleIdByPlateNumber']);
Route::get('/vehicles/{vehicleId}', [CarController::class, 'getReservationByVehicleId']);Route::get('/reservations', [CarController::class, 'getAllReservations']);


Route::post('/create-reservation', [CarController::class, 'createReservation']);