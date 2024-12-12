<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NodeSystemException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        // تخزين معرّف السيارة في السيشن
        session(['new_id' => $request->input('car_id')]);

        // استخراج رقم اللوحة من الطلب
        $plateNumber = preg_replace('/^(?:[A-Z]-|CC-)/', '', $request->input('plate_number'));

        // الحصول على التوكن
        $token = $this->getAuthToken();

        // الحصول على تفاصيل السيارة
        $car = $this->getCarDetailsByPlateNumber($plateNumber, $token);

        // الاستجابة بناءً على حالة السيارة
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
        // التحقق من حالة الحجز
        $reservationResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/reservations/');

        if (!$reservationResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Reservations API.');
        }

        // التحقق من حالة السيارة إذا كانت محجوزة
        $reservations = $reservationResponse->json()['data'];
        foreach ($reservations as $reservation) {
            if ($reservation['status'] === 'Confirmed' && isset($reservation['vehicle_hint']) && str_contains($reservation['vehicle_hint'], $plateNumber)) {
                throw new NodeSystemException('This car is already reserved with a confirmed status.');
            }
        }

        // جلب السيارات من API
        $vehicleListResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');

        if (!$vehicleListResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Node system.');
        }

        // البحث عن السيارة برقم اللوحة
        $vehicles = $vehicleListResponse->json()['data'];
        return collect($vehicles)->firstWhere('plate_number', $plateNumber);
    }

    private function respondCarStatus($car, $plateNumber, $request)
    {
        $carImage = $request->input('car_picture');
        $token = Cache::get('node_api_token') ?? $this->authenticate();

        // إذا كانت السيارة غير موجودة أو غير متوفرة
        if (!$car || $car['status'] !== 'Available') {
            return $this->handleCarUnavailable($carImage, $request, $token);
        }

        // إذا كانت السيارة متوفرة
        $this->storeReservationSessionData($request, $car);

        return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
    }

    private function handleCarUnavailable($carImage, $request, $token)
    {
        // جلب جميع السيارات المتاحة من API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');

        if ($response->successful()) {
            $apiCars = $response->json();

            // تصفية السيارات المتاحة
            $availableCars = collect($apiCars['data'])->filter(function ($car) {
                return isset($car['status']) && $car['status'] === 'Available';
            });

            // استخراج أرقام اللوحات
            $plateNumbers = $availableCars->pluck('plate_number')->map(function ($plate) {
                return preg_replace('/[^0-9]/', '', $plate);
            });

            // جلب السيارات من قاعدة البيانات
            $carsFromDatabase = DB::table('cars')
                ->whereIn(DB::raw("REGEXP_REPLACE(plate_number, '[^0-9]', '')"), $plateNumbers)
                ->get();

            if ($carsFromDatabase->count() >= 3) {
                $selectedCars = $carsFromDatabase->random(3);

                $carData = $selectedCars->map(function ($car) {
                    return [
                        'car_name' => $car->car_name . ' ' . $car->model . ' ' . $car->year,
                        'price_daily' => $car->price_daily,
                        'car_picture' => $car->car_picture,
                    ];
                });

                session(['car_data' => $carData]);
            }
        }

        // إرسال صورة السيارة الحالية مع الرسالة
        session(['car_picture' => $carImage]);

        return redirect()->route('index')
            ->with('error_message', 'Car is not available for booking at the moment. Please check the available options below.')
            ->with('car_picture', session('car_picture'))
            ->with('car_data', session('car_data')); // تمرير البيانات للـ View
    }

    private function storeReservationSessionData($request, $car)
    {
        // تخزين بيانات الحجز في السيشن
        session([
            'pickup_date' => $request->input('pickup_date'),
            'return_date' => $request->input('return_date'),
            'rate_daily' => $request->input('price_daily'),
            'pickup_location' => '71', // Static value
            'return_location' => '71', // Static value
            'status' => 'pending_updates',
            'vehicle_hint' => $request->input('carName'),
            'customer_name' => $request->input('name'),
            'customer_mobile' => $request->input('phone'),
            'customer_email' => $request->input('email'),
            'pickup_city' => $request->input('pickup_city'),
            'car_image' => $car['image_url'] ?? null,
            'new_id' => $request->input('car_id'),
        ]);
    }
}
