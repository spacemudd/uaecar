<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Car;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;

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
            'tax' => 0,
            'status' => 'Payment Recieved',
        ]);

        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => route('successview', ['session_id' => '{CHECKOUT_SESSION_ID}', 'invoice_id' => $invoice->id]),
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'AED',
                        'product_data' => [
                            'name' => $car->car_name . ' ' . $car->model . ' ' . $car->year,
                        ],
                        'unit_amount' => $request->total * 100,
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

    public function successView(Request $request)
    {
        $invoiceId = session('user_invoices');

        if (!$invoiceId) {
            return redirect()->route('payment.cancel');
        }

        $invoice = Invoice::find($invoiceId);
        if (!$invoice) {
            return redirect()->route('payment.cancel');
        }

        $token = $this->getAuthToken();
        if (!$token) {
            return redirect()->route('payment.cancel')->with('error', 'فشل في الحصول على توكن المصادقة');
        }
        $carId = Car::find(session('new_id'));
        // dd($carId);
        $carName = $carId->car_name;
        $carModel = $carId->model;
        $carYear = $carId->year;
        $carPlateNumber = $carId->plate_number;

        $apiUrl = 'https://luxuria.crs.ae/api/v1/reservations';
        $apiData = [
            'customer_name' => $invoice->customer_name,
            'customer_mobile' => $invoice->customer_phone,
            'customer_email' => $invoice->customer_email,
            'customer_nationality' => 'ARE',
            'pickup_location' => '71',
            'return_location' => '71',
            'pickup_date' => session('pickup_date'),
            'return_date' => session('return_date'),
            'vehicle_hint' => $carName . ' ' . $carModel . ' ' . $carYear . ' ' . $carPlateNumber,
            'rate_daily' => $invoice->car_daily_price,
            'status' => 'confirmed',
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($apiUrl, $apiData);

        return view('front.pages.successView', compact('invoiceId'));
    }
}
