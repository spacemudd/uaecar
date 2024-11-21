<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($id)
    {
        $car = $this->getCarById($id);

        $pickupDate = session('pickup_date');
        $returnDate = session('return_date');
        $rateDaily = session('rate_daily');
        $priceDaily = $car->price_daily;
        $days = $this->calculateRentalDays($pickupDate, $returnDate);
        $total = $rateDaily * $days;
        $similarProducts = Car::whereBetween('price_daily', [$priceDaily - 20, $priceDaily + 20])
            ->where('id', '!=', $id)
            ->get();

        return view('front.pages.payment', [
            'car' => $car,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'price_daily' => $priceDaily,
            'days' => $days,
            'total' => $total,
            'pickup_location' => session('pickup_location'),
            'return_location' => session('return_location'),
            'status' => session('status'),
            'vehicle_hint' => session('vehicle_hint'),
            'customer_name' => session('customer_name'),
            'customer_mobile' => session('customer_mobile'),
            'customer_email' => session('customer_email'),
            'similarProducts' => $similarProducts,
        ]);
    }

    public function passDatatoStripe($id)
    {
        $car = $this->getCarById($id);

        $pickupDate = session('pickup_date');
        $returnDate = session('return_date');
        $rateDaily = session('rate_daily');
        $days = $this->calculateRentalDays($pickupDate, $returnDate);
        $total = $rateDaily * $days;

        return redirect()->route('stripe.payment', [
            'car' => $car->id,
            'rate_daily' => $rateDaily,
            'days' => $days,
            'total' => $total,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
        ]);
    }

    private function getCarById($id)
    {
        return Car::findOrFail($id);
    }

    private function calculateRentalDays($pickupDate, $returnDate)
    {
        $pickup = Carbon::parse($pickupDate);
        $return = Carbon::parse($returnDate);

        return max($pickup->diffInDays($return), 1);
    }
}
