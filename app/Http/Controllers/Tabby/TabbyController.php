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
            merchantCode: env('TABBY_MERCHANT_CODE'),
            publicKey: env('TABBY_PUBLIC_KEY'),
            secretKey: env('TABBY_SECRET_KEY'),
            currency: env('TABBY_CURRENCY', 'AED')
        );
    }


    public function createCheckout()
{
    $customerPhone = session('customer_mobile');
  
    try {
        $buyer = new Buyer('500000001', 'card.success@tabby.ai', 'John Doe', '1990-01-01');
        $quantity = (int) '1';

        $order = new Order('order-001', [
            new OrderItem(
                'Product Name',     
                'electronics',       
                100,                 
                0.00,                
                $quantity,           
                false,               
                'Product Description',
                'user-phone-'. session('customer_mobile')
            )
        ]);

        $shippingAddress = new ShippingAddress('Al-Khobar', 'Street Address', '12345');

        $checkoutSession = $this->tabbyService->createSession(
            200, // Amount
            $buyer,
            $order,
            $shippingAddress,
            'Order description',
            url('/payment/success'), // Success URL
            url('/payment/cancel'),  // Cancel URL
            url('/payment/failure')  // Failure URL
        );

        return redirect($checkoutSession->getPaymentUrl());

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function paymentSuccess(Request $request)
{
    // Handle successful payment logic here
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
