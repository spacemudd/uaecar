<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Car;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;
use App\Mail\InvoiceEmail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendInvoiceEmailJob;


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
        
        $deposite_amount = 0;
        if ($car->price_daily <= 349){
            $deposite_amount = 1000;
        }else{
            $deposite_amount = 0;
        }
        // قم بإنشاء جلسة الدفع في Stripe
        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => route('successview', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'AED',
                        'product_data' => [
                            'name' => $car->car_name . ' ' . $car->model . ' ' . $car->year,
                            'description' => 'Pickup Date: ' . $request->pickup_date,
                            'description' => 'Return Date: ' . $request->return_date,

                            'images' => [asset('storage/' . $car->car_picture)],                        
                        ],
                        'unit_amount' => $request->total * 100, // المبلغ الأصلي
                    ],
                    'quantity' => 1,
                ],
                // إضاeفة مبلغ التأمين
                [
                    'price_data' => [
                        'currency' => 'AED',
                        'product_data' => [
                            'name' => 'Deposit (Security)',
                        ],
                        'unit_amount' => $deposite_amount * 100, // 1000 درهم تأمين
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
        
        return redirect($session->url);
    }

    public function getAuthToken()
    {
        $loginUrl = 'https://luxuria.crs.ae/api/v1/auth/jwt/token';
        $response = Http::post($loginUrl, [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ]);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        return null;
    }


    public function createInvoice(Request $request)
    {
        dd(session()->all());
        
        if (session('rate_daily') >= 348) {
            return Invoice::create([
                'customer_name' => session('customer_name'),
                'customer_email' => session('customer_email'),
                'customer_phone' => session('customer_mobile'),
                'city' => $request->customer_city,
                'pickup_date' => session('pickup_date'),
                'return_date' => session('return_date'),
                'creation_date' => now(),
                'description' => session('car_name'),
                'car_daily_price' => session('rate_daily'),
                'total_days' => \Carbon\Carbon::parse(session('pickup_date'))
                    ->diffInDays(\Carbon\Carbon::parse(session('return_date'))),
                'total_amount' => session('total'),
                'tax' => 0,
                'status' => 'Payment Received',
            ]);
        } else {
            return Invoice::create([
                'customer_name' => session('customer_name'),
                'customer_email' => session('customer_email'),
                'customer_phone' => session('customer_mobile'),
                'city' => session('customer_address'),
                'pickup_date' => session('pickup_date'),
                'return_date' => session('return_date'),
                'creation_date' => now(),
                'description' => session('car_name'),
                'car_daily_price' => session('rate_daily'),
                'total_days' => \Carbon\Carbon::parse(session('pickup_date'))
                    ->diffInDays(\Carbon\Carbon::parse(session('return_date'))),
                'total_amount' => session('total'),
                'tax' => 1000,
                'status' => 'Payment Received',
            ]);
        }
    }
    


    public function successView(Request $request)
    {
      
    
        $token = $this->getAuthToken();
        if (!$token) {
            return redirect()->route('payment.cancel')->with('error', 'فشل في الحصول على توكن المصادقة');
        }
    
        // استدعاء دالة createInvoice هنا
        $invoice = $this->createInvoice($request);
        $invoiceId = $invoice->id;
        $carId = Car::find(session('new_id'));
        $carName = $carId->car_name;
        $carModel = $carId->model;
        $carYear = $carId->year;
        $carPlateNumber = $carId->plate_number;
        $pickupDate = \Carbon\Carbon::parse(session('pickup_date'))->format('Y-m-d H:i:s');
        $returnDate = \Carbon\Carbon::parse(session('return_date'))->format('Y-m-d H:i:s');
    
        $apiUrl = 'https://luxuria.crs.ae/api/v1/reservations';
        $apiData = [
            'customer_name' => $invoice->customer_name,
            'customer_mobile' => $invoice->customer_phone,
            'customer_email' => $invoice->customer_email,
            'customer_nationality' => 'ARE',
            'pickup_location' => '71',
            'return_location' => '71',
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'vehicle_hint' => $carName . ' ' . $carModel . ' ' . $carYear . ' ' . $carPlateNumber,
            'rate_daily' => session('rate_daily'),
            'status' => 'confirmed',
        ];
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($apiUrl, $apiData);
    
        SendInvoiceEmailJob::dispatch($invoice);      
        return view('front.pages.successView', compact('invoiceId'));
    }
    
}
