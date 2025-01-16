<?php

namespace App\Http\Controllers\Tabby;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tabby\Services\TabbyService;
use Tabby\Models\Buyer;
use Tabby\Models\Order;
use Tabby\Models\ShippingAddress;
use Tabby\Models\OrderItem;


class TabbyController extends Controller
{
    

    private $tabbyService;

    public function __construct()
    {
        $this->tabbyService = new TabbyService(
            merchantCode: 'LCRUAE',
            publicKey: 'pk_test_01931b02-3220-d834-30ad-578f01330b70',
            secretKey: 'sk_test_01931b02-3220-d834-30ad-578f65ed8f27',
            currency: 'AED',
        );
    }


    public function createCheckout()
{
    $customerPhone = session('customer_mobile');
    $customerName = session('customer_name');
    $customerEmail = session('customer_email');
    $carId = session('car_id');
    $booking_duration = session('booking_duration');
    if ($booking_duration == 'Weekly'){
        $totalPrice = $carId->price_weekly + 1000;
    }
    
  
    try {
        $buyer = new Buyer('500000001', 'card.success@tabby.ai', $customerName, '1990-01-01');
        $quantity = (int) '1';

        $order = new Order('order-001', [
            new OrderItem(
                $carId->car_name . $carId->model,     
                $carId->categories,       
                100,                 
                0.00,                
                $quantity,           
                false,               
                'Product Description',
                'user-phone-'. $customerPhone
            )
        ]);

        $shippingAddress = new ShippingAddress('Al-Khobar', 'Street Address', '12345');

        $checkoutSession = $this->tabbyService->createSession(
            200, // Amount
            $buyer,
            $order,
            $shippingAddress,
            'Order description',
            url('/home'), // Success URL
            url('/cancel'),  // Cancel URL
            url('/failed')  // Failure URL
        );

        session()->flash('success_message', 'تمت العملية بنجاح!');
        session()->flash('cancel_message', 'تم رفض العملية!');
        session()->flash('failure_message', 'فشل العملية');


        return redirect($checkoutSession->getPaymentUrl());

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function paymentSuccess(Request $request)
{
    dd('hello');
    return response()->json(['message' => 'Payment successful!']);
}

public function paymentCancel(Request $request)
{
    // Handle canceled payment logic here
    return response()->json(['message' => 'Payment canceled.']);
}

public function paymentFailure(Request $request)
{
    // Handle failed payment logic here
    return response()->json(['message' => 'Payment failed!']);
}


public function retrievePayment($paymentId)
{
    try {
        $payment = $this->tabbyService->retrievePayment($paymentId);
        return response()->json($payment);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function refundPayment($paymentId)
{
    try {
        $refund = $this->tabbyService->refundPayment(
            $paymentId,
            50.00,  // Amount to refund
            'refund_reason_here'
        );
        return response()->json(['message' => 'Refund processed!', 'data' => $refund]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function webhookHandler(Request $request)
{
    $event = $request->all();
    // Validate and process webhook events here

    return response()->json(['message' => 'Webhook processed.'], 200);
}


   

}