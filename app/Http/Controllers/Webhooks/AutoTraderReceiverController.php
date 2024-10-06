<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Services\AutoTraderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AutoTraderReceiverController extends Controller
{
    public function index(Request $request)
    {
        Log::info($request->getContent());

        $textbefore = Str::before($request->header('autotrader-signature'), ', v1=');
        $timestamp = Str::after($textbefore, 't=');
        $sig = Str::after($request->header('autotrader-signature'), 'v1=');

        $hash = hash_hmac('sha256', $timestamp . '.' . $request->getContent(), config('autotrader.secret'));

        if ($hash !== $sig) {
            \Log::error('Invalid sig');
            //return response()->json(['error' => 'Invalid signature'], 401);
        }

        $newAaData = json_decode($request->getContent(), true);

        $car = Car::where('at_stock_id', $newAaData['id'])->first();
        if ($car) {
            $service = new AutoTraderService();
            return $service->updateCarFromNotification($newAaData['id'], $request->getContent());
        } else {
            $service = new AutoTraderService();
            return $service->createNewCar($newAaData['id'], json_decode($request->getContent(), true));
        }
    }
}
