<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NodeSystemException;
use Illuminate\Support\Facades\DB;
use App\Models\Car;

class FormController extends Controller
{
    /**
     * تقديم الطلب للتحقق من السيارة وحجزها.
     */
    public function submit(Request $request)
    {
        // حفظ car_id في السيشن
        session(['new_id' => $request->input('car_id')]);

        // تنظيف رقم اللوحة لإزالة أي إضافات
        $plateNumber = $this->sanitizePlateNumber($request->input('plate_number'));

        // الحصول على التوكن من الـ Cache أو المصادقة إذا لم يكن موجود
        $token = $this->getAuthToken();

        // الحصول على تفاصيل السيارة عبر رقم اللوحة
        $car = $this->getCarDetailsByPlateNumber($plateNumber, $token);

        // الرد بناءً على حالة السيارة
        return $this->respondCarStatus($car, $plateNumber, $request);
    }

    /**
     * مسح رقم اللوحة لتجنب الحروف الزائدة.
     */
    private function sanitizePlateNumber($plateNumber)
    {
        return preg_replace('/^(?:[A-Z]-|CC-)/', '', $plateNumber);
    }

    /**
     * الحصول على التوكن من الـ Cache أو طلب توكن جديد.
     */
    private function getAuthToken()
    {
        $token = Cache::get('node_api_token');
        if (!$token) {
            $token = $this->authenticate();
        }
        return $token;
    }

    /**
     * مصادقة المستخدم للحصول على توكن جديد.
     */
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

    /**
     * الحصول على تفاصيل السيارة عبر رقم اللوحة.
     */
    private function getCarDetailsByPlateNumber($plateNumber, $token)
    {
        // التحقق من حالة الحجز
        $reservationResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/reservations/');

        if (!$reservationResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Reservations API.');
        }

        $reservations = $reservationResponse->json()['data'];

        // التحقق إذا كانت السيارة محجوزة
        foreach ($reservations as $reservation) {
            // التحقق إذا كانت السيارة محجوزة ومؤكدة
            if ($reservation['status'] === 'Confirmed' && isset($reservation['vehicle_hint'])) {
                $plateNumber = preg_replace('/[^0-9]/', '', $reservation['vehicle_hint']); // استخراج رقم اللوحة
    
                // البحث عن السيارة في قاعدة البيانات باستخدام رقم اللوحة
                $carFromDatabase = DB::table('cars')
                    ->where(DB::raw("REGEXP_REPLACE(plate_number, '[^0-9]', '')"), $plateNumber)
                    ->first();
    
                if ($carFromDatabase) {
                    // إذا تم العثور على السيارة في قاعدة البيانات
                    $carData = [
                        'car_name' => $carFromDatabase->car_name,
                        'price_daily' => $carFromDatabase->price_daily,
                        'model' => $carFromDatabase->model,
                        'car_picture' => $carFromDatabase->car_picture,
                    ];
    
                    // حفظ بيانات السيارة في الجلسة
                    session(['car_reserved' => true]);
                    session(['reserved_car_data' => $carData]);
    
                    // إرجاع رسالة بأن السيارة محجوزة مع بيانات السيارة
                    return redirect()->route('index')
                        ->with('error_message_reservation', 'This car is confirmed reserved. Here are the car details.')
                        ->with('car_details', $carData);
                }
            }
        }
        
        
        
        // الحصول على قائمة السيارات المتوفرة
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

    /**
     * التعامل مع حالة السيارة بعد التحقق من حالتها.
     */
    private function respondCarStatus($car, $plateNumber, $request)
    {
        // جلب صورة السيارة من الطلب
        $carImage = $request->input('car_picture');
        $token = Cache::get('node_api_token') ?? $this->authenticate();

        // تحديد الرسالة بناءً على حالة السيارة
        if (!$car) {
            $errorMessage = 'Car not found. Please check the available options below.';
        } elseif ($car['status'] !== 'Available') {
            $errorMessage = 'Car is not available for booking at the moment. Please check the available options below.';
        } else {
            // إذا كانت السيارة متاحة، حفظ بيانات الحجز
            $this->storeReservationData($request, $car);
            return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }

        // إذا كانت السيارة غير متاحة، إظهار السيارات البديلة
        $this->handleCarNotAvailable($token, $carImage);
        return redirect()->route('index')
            ->with('error_message', $errorMessage)
            ->with('car_picture', session('car_picture'))
            ->with('car_data', session('car_data'));
    }

    /**
     * حفظ بيانات الحجز في السيشن.
     */
    private function storeReservationData($request, $car)
    {
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

    /**
     * التعامل مع حالة السيارة غير المتوفرة وإظهار السيارات البديلة.
     */
    private function handleCarNotAvailable($token, $carImage)
    {
        // جلب قائمة السيارات المتاحة
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

            // جلب السيارات البديلة من قاعدة البيانات
            $carsFromDatabase = DB::table('cars')
                ->whereIn(DB::raw("REGEXP_REPLACE(plate_number, '[^0-9]', '')"), $plateNumbers)
                ->get();

            // إذا كانت هناك سيارات بديلة
            if ($carsFromDatabase->count() >= 3) {
                $selectedCars = $carsFromDatabase->random(3);

                $carData = $selectedCars->map(function ($car) {
                    return [
                        'car_name' => $car->car_name . ' ' . $car->model . ' ' . $car->year,
                        'price_daily' => $car->price_daily,
                        'car_picture' => $car->car_picture,
                    ];
                });

                // حفظ السيارات البديلة في السيشن
                session(['car_data' => $carData]);
            }
        }

        // حفظ صورة السيارة الحالية في السيشن
        session(['car_picture' => $carImage]);
    }
}
