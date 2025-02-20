<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Car;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;
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
        if ($car->price_daily <= 349) {
            $deposite_amount = 1000;
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
                            'images' => [asset('storage/' . $car->car_picture)],
                        ],
                        'unit_amount' => $request->total * 100, // المبلغ الأصلي
                    ],
                    'quantity' => 1,
                ],
                // إضافة مبلغ التأمين
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
        
        // تخزين معرف الجلسة في الجلسة
        session(['checkout_session_id' => $session->id]);

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
        $sessionId = $request->get('session_id');

        // استرداد معلومات الجلسة من Stripe
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);

        // التحقق من نجاح الدفع
        if ($session->payment_status === 'paid') {
            // الآن يمكنك إنشاء الفاتورة
            if(session('rate_daily') >= 348){
                $invoice = Invoice::create([
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'city' => $request->customer_city,
                    'pickup_date' => session('pickup_date'),
                    'return_date' => session('return_date'),
                    'creation_date' => now(),
                    'description' => "This is a new Car",
                    'car_daily_price' => session('rate_daily'),
                    'total_days' => \Carbon\Carbon::parse(session('pickup_date'))
                        ->diffInDays(\Carbon\Carbon::parse(session('return_date'))),
                    'total_amount' => $request->total,
                    'tax' => 0,
                    'status' => 'Payment Received',
                ]);
            }else{
                $invoice = Invoice::create([
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'city' => $request->customer_city,
                    'pickup_date' => session('pickup_date'),
                    'return_date' => session('return_date'),
                    'creation_date' => now(),
                    'description' => session('car_name'),
                    'car_daily_price' => session('rate_daily'),
                    'total_days' => \Carbon\Carbon::parse(session('pickup_date'))
                        ->diffInDays(\Carbon\Carbon::parse(session('return_date'))),
                    'total_amount' => $request->total,
                    'tax' => 1000,
                    'status' => 'Payment Received',
                ]);
            }

            // إرسال البريد الإلكتروني مع الفاتورة
            SendInvoiceEmailJob::dispatch($invoice);
        }

        return view('front.pages.successView', compact('invoice'));
    }
}
