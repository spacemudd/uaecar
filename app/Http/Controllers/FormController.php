<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NodeSystemException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Car;



class FormController extends Controller
{
    public function submit(Request $request)
    {
        session('new_id', $request->input('car_id'));
        $plateNumber = $request->input('plate_number');
        $plateNumber = preg_replace('/^(?:[A-Z]-|CC-)/', '', $plateNumber);    
        $token = $this->getAuthToken();
    
        $car = $this->getCarDetailsByPlateNumber($plateNumber, $token);
    
        return $this->respondCarStatus($car, $plateNumber, $request);
    }
    

    private function getAuthToken()
    {
        $token = Cache::get('node_api_token');
        if (!$token) {
            $token = $this->authenticate();
        }
        return $token;
    }

    private function authenticate()
    {
        $username = 'info@rentluxuria.com';
        $password = ')ixLj(CQYSE84MRMqm*&dega';

        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['token'])) {
                $token = $responseData['token'];
                Cache::put('node_api_token', $token, now()->addHours(1));
                return $token;
            }
            throw new NodeSystemException('Authentication failed: access_token not found.');
        }

        throw new NodeSystemException('Authentication failed: ' . ($response->json()['message'] ?? 'Unknown error.'));
    }

    private function getCarDetailsByPlateNumber($plateNumber, $token)
    {
        // الخطوة الأولى: التحقق من حالة الحجز
        $reservationResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/reservations/');
    
        if (!$reservationResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Reservations API.');
        }
    
        $reservations = $reservationResponse->json()['data'];
    
        foreach ($reservations as $reservation) {
            if ($reservation['status'] === 'Confirmed' && isset($reservation['vehicle_hint']) && str_contains($reservation['vehicle_hint'], $plateNumber)) {
                throw new NodeSystemException('This car is already reserved with a confirmed status.');
            }
        }
        $vehicleListResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        if (!$vehicleListResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Node system.');
        }
    
        $vehicles = $vehicleListResponse->json()['data'];
    
        // البحث عن السيارة برقم اللوحة
        return collect($vehicles)->firstWhere('plate_number', $plateNumber);
    }
    
    
    

    private function respondCarStatus($car, $plateNumber, $request)
    {
        $carImage = $request->input('car_picture');
    
        // إذا كانت السيارة غير موجودة أو غير متاحة
        if (!$car || $car['status'] !== 'Available') {
            $token = Cache::get('node_api_token');
    
            if (!$token) {
                $token = $this->authenticate();
            }
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('https://luxuria.crs.ae/api/v1/vehicles');
    
            $suggestedCars = [];
            if ($response->successful()) {
                $apiCars = $response->json();
    
                // تصفية السيارات المتاحة
                $availableCars = collect($apiCars['data'])->filter(function ($car) {
                    return isset($car['status']) && $car['status'] === 'Available';
                });
    
                // اختيار 3 سيارات مقترحة
                $suggestedCars = $availableCars->take(3)->map(function ($car) {
                    return [
                        'car_name' => $car['make'] . ' ' . $car['model'],
                        'price_daily' => $car['rate_daily'],
                        'car_picture' => $car['image_url']
                    ];
                });
            }
    
            // تخزين السيارات المقترحة في الجلسة
            session(['car_data' => $suggestedCars]);
            session(['car_picture' => $carImage]);
    
            // توجيه المستخدم مع رسالة الخطأ
            return redirect()->route('index')
                ->with('error_message', 'The car is either not available or not found in the system. Please check the suggested cars below.')
                ->with('car_picture', session('car_picture'));
        }
    
        // إذا كانت السيارة متاحة
        session([
            'pickup_date' => $request->input('pickup_date'),
            'return_date' => $request->input('return_date'),
            'rate_daily' => $request->input('price_daily'),
            'pickup_location' => '71',  // قيمة ثابتة
            'return_location' => '71',  // قيمة ثابتة
            'status' => 'pending_updates',
            'vehicle_hint' => $request->input('carName'),
            'customer_name' => $request->input('name'),
            'customer_mobile' => $request->input('phone'),
            'customer_email' => $request->input('email'),
            'pickup_city' => $request->input('pickup_city'),
            'car_image' => $car['image_url'] ?? null,
            'new_id' => $request->input('car_id')
        ]);
    
        // التوجيه إلى صفحة الدفع
        return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
    }
    
    
    

    
}
