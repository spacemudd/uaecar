<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Car;
use App\Models\Invoice;

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
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'price_daily' => 'required|numeric',
            'days' => 'required|integer|min:1',
            'total' => 'required|numeric',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_city' => 'required|string',
        ]);
    
        $car = Car::find($request->car_id);
    
        // After creating the invoice
        $invoice = Invoice::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'city' => $request->customer_city,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'creation_date' => now(),
            'description' => "This is a new Car",
            'car_daily_price' => "10.2",
            'total_days' => 12,
            'total_amount' => $request->total,
            'tax' => 0, // Optional: set the tax if applicable
            'status' => 'Payment Recieved', // Change to 'paid' after successful payment confirmation
        ]);
    
        // Stripe payment logic
        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => route('successview', ['session_id' => '{CHECKOUT_SESSION_ID}', 'invoice_id' => $invoice->id]),
            'cancel_url' => route('payment.cancel'),
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'AED',
                        'product_data' => [
                            'name' => $car->car_name . ' ' . $car->model . ' ' . $car->year,
                        ],
                        'unit_amount' => $request->total * 100, // Stripe expects amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                'pickup_date' => $request->pickup_date,
                'return_date' => $request->return_date,
                'days' => $request->days,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'pickup_city' => $request->customer_city,
            ],
        ]);
    
        session(['user_invoices' => $invoice->id]);
    
        return redirect($session->url);
    }
    


    public function successView(Request $request)
    {
        // احصل على معرف الفاتورة من الجلسة
        $invoiceId = session('user_invoices');
    
        
    
        return view('front.pages.successView', compact('invoiceId'));
    }
    
    
}
