<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // إضافة هذا السطر
use Illuminate\Support\Facades\Log;



class PaymentController extends Controller
{

   
    public function show($id)
    {
        $car = $this->getCarById($id);
        session(['car_id' => $car]);


        $pickupDate = session('pickup_date');
        $returnDate = session('return_date');
        $rateDaily = session('rate_daily');
        $priceDaily = $car->price_daily;
        $days = $this->calculateRentalDays($pickupDate, $returnDate);
        if (session('booking_duration') == 'Weekly') {
            $total = session('rate_weekly');
        }
        if (session('booking_duration') == 'Monthly') {
            $total = session('rate_monthly');
        }
        if (session('booking_duration') == 'Daily') {
            $total = $rateDaily * $days;

        }
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
            'pickup_city' => session('pickup_city'),
        ]);
    }

    public function passDatatoStripe($id)
    {
        $car = $this->getCarById($id);

        // استرجاع معلومات استئجار السيارة من الجلسة
        $pickupDate = session('pickup_date');
        $returnDate = session('return_date');
        $rateDaily = session('rate_daily');
        $days = $this->calculateRentalDays($pickupDate, $returnDate);
        $total = $rateDaily * $days;
    
        // معلومات العميل (تأكد من أن هذه المعلومات متاحة في الجلسة)
        $customerName = session('customer_name');
        $customerEmail = session('customer_email');
        $customerPhone = session('customer_phone');
        $customerCity = session('customer_city');
    
        return redirect()->route('stripe.payment', [
            'car_id' => session('car_id'),
            'rate_daily' => $rateDaily,
            'days' => $days,
            'total' => $total,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_city' => $customerCity,
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
