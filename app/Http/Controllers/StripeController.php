<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public $stripe;

    public function __construct()
    {
        $stripeSecretKey = env('STRIPE_SECRET_KEY');
        
        if (empty($stripeSecretKey)) {
            throw new \Exception('Stripe secret key is not set in the environment file.');
        }
        $this->stripe = new StripeClient($stripeSecretKey);
    }
    

    public function pay(Request $request)
    {
        $carName = $request->input('car_name');
        $totalPrice = $request->input('total_price');
        $priceDaily = $request->input('price_daily');
        $pickupDate = $request->input('pickup_date');
        $returnDate = $request->input('return_date');
    
        // Use this data to display the car information on the payment page or process payment logic
        return view('payment', compact('carName', 'totalPrice', 'priceDaily', 'pickupDate', 'returnDate'));
    }
    
}
