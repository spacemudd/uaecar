<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Car;

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
    

    public function pay($car_id, $rate_daily, $days, $total, $pickup_date, $return_date)
    {
        // استرجاع السيارة باستخدام car_id
        $car = Car::find($car_id);

        // Stripe payment logic
        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/success',
            'cancel_url' => 'http://127.0.0.1:8000/cancel',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'AED',
                        'product_data' => [
                            'name' => $car->car_name . ' ' . $car->model . ' ' . $car->year,
                        ],
                        'unit_amount' => $total * 100, // Stripe expects amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                // 'car_id' => $car->id,
                // 'pickup_location' => $pickup_location,
                // 'return_location' => $return_location,
                // 'customer_name' => $customer_name,
                // 'customer_email' => $customer_email,
                'pickup_date' => $pickup_date,
                'return_date' => $return_date,
                'days' => $days,
                // 'status' => $status,
            ],
        ]);
        
    
        return redirect($session->url);
    }
    
}
