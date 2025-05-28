<?php

use App\Http\Controllers\Api\AdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tabby\CheckoutController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\UserController;

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/luxury', [CarController::class, 'luxury_cars']);
    Route::get('/mid', [CarController::class, 'mid_rang_cars']);
    Route::get('/economy', [CarController::class, 'economy_cars']);
    Route::get('/sports', [CarController::class, 'sport_cars']);
    Route::get('/vans', [CarController::class, 'vans_cars']);
    Route::get('/{car_id}', [CarController::class, 'getCarById']);

    Route::post('/get-vehicle-id', [CarController::class, 'getVehicleIdByPlateNumber']);
    Route::get('/vehicles/{vehicleId}', [CarController::class, 'getReservationByVehicleId']);
    Route::get('/reservations', [CarController::class, 'getAllReservations']);
    Route::post('/create-reservation', [CarController::class, 'createReservation']);
    Route::post('/check-vehicle-availability', [CarController::class, 'checkVehicleAvailability']);
    Route::post('/create-checkout-session', [CarController::class, 'createStripeCheckoutSession']);
    Route::post('/save-prebooking', [CarController::class, 'savedDataprebooking']);
    Route::post('/bookings', [CarController::class, 'bookings']);
    Route::get('/bookings/user/{user_id}', [CarController::class, 'getBookingsByUser']);
    Route::delete('/bookings/{booking_id}', [CarController::class, 'deleteBooking']);
    Route::get('/payment/success/{booking_id}', [CarController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/invoices/user/{user_id}', [CarController::class, 'getInvoicesByUser']);
    Route::get('/invoices/{invoice_id}', [CarController::class, 'getInvoiceById']);
    Route::get('/ads/latest', [CarController::class, 'getLatestAd']);
    Route::get('/no-deposite',[CarController::class, 'getNoDepositCars']);
});
Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::post('/check-phone', [UserController::class, 'checkPhoneNumber']);
    Route::middleware('auth:sanctum')->delete('/delete-account', [UserController::class, 'deleteAccount']);
});

Route::get('/reserve-car', [CarController::class, 'authenticate']);
Route::get('/ads/latest', [AdController::class, 'getLatestAd']);
