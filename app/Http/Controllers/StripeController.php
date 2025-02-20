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
        
        $deposit_amount = 0;
        if ($car->price_daily <= 349) {
            $deposit_amount = 1000;
        }

        // إنشاء جلسة الدفع في Stripe
        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => route('successview', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('cancelview'), // رابط للتراجع عن الدفع
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
                        'unit_amount' => $deposit_amount * 100, // 1000 درهم تأمين
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
        session(['customer_data' => $request->only(['customer_name', 'customer_email', 'customer_phone', 'customer_city', 'pickup_date', 'return_date'])]);

        return redirect($session->url);
    }

    public function successView(Request $request)
    {
        $sessionId = $request->get('session_id');

        // استرداد معلومات الجلسة من Stripe
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);

        // التحقق من نجاح الدفع
        if ($session->payment_status === 'paid') {
            $customerData = session('customer_data');
            $invoice = Invoice::create([
                'customer_name' => $customerData['customer_name'],
                'customer_email' => $customerData['customer_email'],
                'customer_phone' => $customerData['customer_phone'],
                'city' => $customerData['customer_city'],
                'pickup_date' => $customerData['pickup_date'],
                'return_date' => $customerData['return_date'],
                'creation_date' => now(),
                'description' => "Payment for Car Rental",
                'car_daily_price' => $session->amount_total / 100, // استخدم المبلغ الإجمالي من الجلسة
                'total_days' => \Carbon\Carbon::parse($customerData['pickup_date'])
                    ->diffInDays(\Carbon\Carbon::parse($customerData['return_date'])),
                'total_amount' => $session->amount_total / 100,
                'tax' => 0, // إذا كان لديك ضريبة، قم بتحديث هذه القيمة
                'status' => 'Payment Received',
            ]);

            // إرسال البريد الإلكتروني مع الفاتورة
            SendInvoiceEmailJob::dispatch($invoice);
        }

        return view('front.pages.successView', compact('invoice'));
    }
}
