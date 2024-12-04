<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tabby\CheckoutController;

// Route لإنشاء جلسة Checkout
Route::post('/tabby/checkout', [CheckoutController::class, 'postCheckout']);

// Route لاسترجاع جلسة Checkout موجودة
Route::get('/tabby/checkout/{id}', [CheckoutController::class, 'getCheckoutSession']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



