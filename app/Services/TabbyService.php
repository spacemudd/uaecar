<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TabbyService
{
    protected $publicKey;
    protected $secretKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->publicKey = env('TABBY_PUBLIC_KEY');
        $this->secretKey = env('TABBY_SECRET_KEY');
        $this->baseUrl = env('TABBY_BASE_URL');
    }

    public function createSession(array $data)
    {
        $url = $this->baseUrl . '/checkout';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to create Tabby session: ' . $response->body());
    }

    public function getSessionStatus($sessionId)
    {
        $url = $this->baseUrl . "/checkout/$sessionId";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch session status: ' . $response->body());
    }
}
