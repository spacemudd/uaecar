<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Car;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\PDF; // إضافة الـ PDF

class StripeController extends Controller
{
    public $stripe;
    protected $pdf; // تعريف الكائن PDF

    // تعديل constructor لحقن الكائن PDF
    public function __construct(PDF $pdf)
    {
        $stripeSecretKey = env('STRIPE_SECRET_KEY');
        if (empty($stripeSecretKey)) {
            throw new \Exception('Stripe secret key is not set in the environment file.');
        }
        $this->stripe = new StripeClient($stripeSecretKey);
        $this->pdf = $pdf; // تخزين الكائن PDF لاستخدامه لاحقًا
    }

    public function pay(Request $request)
    {
        // تحقق البيانات المدخلة من المستخدم
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
            'pickup_date' => session('pickup_date'),
            'return_date' => session('return_date'),
            'creation_date' => now(),
            'description' => "This is a new Car",
            'car_daily_price' => session('rate_daily'),
            'total_days' => \Carbon\Carbon::parse(session('pickup_date'))
            ->diffInDays(\Carbon\Carbon::parse(session('return_date'))),
            'total_amount' => $request->total,
            'tax' => 1000,
            'status' => 'Payment Recieved',
        ]);

        // إنشاء جلسة دفع باستخدام Stripe
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

        // إنشاء ملف PDF للفاتورة باستخدام الكائن الـ PDF المحقون
        $pdf = $this->pdf->loadView('front.pages.stripe.invoice', ['invoice' => $invoice]);

        // إرسال الفاتورة عبر البريد الإلكتروني
        Mail::send('emails.invoice', ['invoice' => $invoice], function($message) use ($invoice, $pdf) {
            $message->to($invoice->customer_email)
                    ->subject('Your Invoice')
                    ->attachData($pdf->output(), 'invoice_' . $invoice->id . '.pdf');
        });

        // إرسال إشعار بنجاح الدفع
        return view('front.pages.successView', compact('invoiceId'));
    }
}
