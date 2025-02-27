<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tabby\CheckoutController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\UserController;
use Stripe\Stripe;
use Stripe\Webhook;









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


Route::post('/check-vehicle-availability', [CarController::class, 'checkVehicleAvailability']);


Route::post('/create-checkout-session', [CarController::class, 'createStripeCheckoutSession']);


Route::post('/webhook/stripe', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
    $payload = $request->getContent();
    $sig_header = $request->header('Stripe-Signature');

    try {
        $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
    } catch (\UnexpectedValueException $e) {
        return response()->json(['error' => 'Invalid payload'], 400);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    // تحقق من نوع الحدث
    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object;

        // استرجاع session_id من الجلسة
        $storedSessionId = session('stripe_session_id');

        // تحقق مما إذا كان session_id المتلقاة تتطابق مع تلك المخزنة في الجلسة
        if ($storedSessionId === $session->id) {
            // هنا يمكنك إجراء العمليات اللازمة بعد تأكيد الدفع
            // على سبيل المثال، يمكنك إرسال إشعار أو تحديث حالة في واجهة المستخدم
        }
    }

    return response()->json(['status' => 'success']);
});