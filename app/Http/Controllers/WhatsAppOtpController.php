<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WhatsAppOtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->input('phone'); // e.g., +9665XXXXX5XXX
        $otp = rand(100000, 999999); // توليد كود OTP

        // خزّنه مؤقتًا لمدة 5 دقائق
        Cache::put("otp_{$phone}", $otp, now()->addMinutes(5));

        // إعدادات واتساب API
        $accessToken = env('WHATSAPP_TOKEN');
        $phoneNumberId = env('WHATSAPP_PHONE_ID');
        $templateName = 'otp_login'; // لازم تكون عامله في Meta
        $languageCode = 'en_US';

        $response = Http::withToken($accessToken)
            ->post("https://graph.facebook.com/v19.0/{$phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $phone,
                'type' => 'template',
                'template' => [
                    'name' => $templateName,
                    'language' => ['code' => $languageCode],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => (string)$otp
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

        if ($response->successful()) {
            return response()->json(['message' => 'OTP sent via WhatsApp']);
        }

        return response()->json(['error' => 'Failed to send OTP', 'details' => $response->json()], 500);
    }
}