<?php 


namespace App\Services;

use Illuminate\Support\Facades\Http;

class TabbyService
{
    protected $publicKey;
    protected $secretKey;
    protected $merchantCode;

    public function __construct()
    {
        $this->publicKey = env('TABBY_PUBLIC_KEY');
        $this->secretKey = env('TABBY_SECRET_KEY');
        $this->merchantCode = env('TABBY_MERCHANT_CODE');
    }

    public function createPaymentSession($amount)
    {
        // مثال لإنشاء جلسة دفع
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
        ])->post('https://api.tabby.ai/v1/checkout', [
            'amount' => $amount,
            'merchant_code' => $this->merchantCode,
        ]);

        return $response->json();
    }
}
