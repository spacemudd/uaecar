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
        dd($carImage);
        session('car_img', $carImage);
        dd(session($carImage));
        
        if (!$car) {
            // إذا كانت السيارة غير موجودة في النظام
            return redirect()->route('index')->with('error_message', 'Car not found in the Node system. Plate number: ' . $plateNumber)
            ->with('car_img', session('car_img'));

            
        }
    
        if ($car['status'] == 'Available') {

            // إذا كانت السيارة متاحة
            session([
                'pickup_date' => $request->input('pickup_date'),
                'return_date' => $request->input('return_date'),
                'rate_daily' => $request->input('price_daily'),
                'pickup_location' => '71',  // Static value
                'return_location' => '71',  // Static value
                'status' => 'pending_updates',
                'vehicle_hint' => $request->input('carName'),
                'customer_name' => $request->input('name'),
                'customer_mobile' => $request->input('phone'),
                'customer_email' => $request->input('email'),
                'pickup_city' => $request->input('pickup_city'),
                'car_image' => $car['image_url'] ?? null,
                'new_id' =>$request->input('car_id')  // Assuming image_url exists in car data
            ]);
    
            // التوجيه إلى صفحة الدفع
            return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }


        $token = Cache::get('node_api_token');
    
        if (!$token) {
            $token = $this->authenticate();
        }
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');
        if ($response->successful()) {
            $apiCars = $response->json();
        
            // تصفية السيارات المتاحة
            $availableCars = collect($apiCars['data'])->filter(function ($car) {
                return isset($car['status']) && $car['status'] === 'Available';
            });
        
            // استخراج أرقام اللوحات الخاصة بالسيارات
            $plateNumbers = $availableCars->pluck('plate_number')->map(function ($plate) {
                return preg_replace('/[^0-9]/', '', $plate); // إزالة أي حرف غير الأرقام من رقم اللوحة
            });
        
            // البحث في قاعدة البيانات باستخدام أرقام اللوحات
            $carsFromDatabase = DB::table('cars')
                ->whereIn(DB::raw("REGEXP_REPLACE(plate_number, '[^0-9]', '')"), $plateNumbers)
                ->get();
        
            // التأكد من أن عدد السيارات التي تم استرجاعها هو 3 سيارات
            if ($carsFromDatabase->count() >= 3) {
                // اختيار 3 سيارات عشوائيًا من قاعدة البيانات
                $selectedCars = $carsFromDatabase->random(3);
        
                // تخزين البيانات في الجلسة
                $carData = $selectedCars->map(function ($car) {
                    return [
                        'car_name' => $car->make . ' ' . $car->model,
                        'model' => $car->model,
                        'year' => $car->year,
                        'price_daily' => $car->price_daily,
                        'car_picture' => $car->car_picture // تأكد من أن لديك عمود car_picture في قاعدة البيانات
                    ];
                });
        
                // تخزين البيانات في الجلسة
                session(['car_data' => $carData]);
            } else {
                // في حال لم توجد 3 سيارات، يمكن إضافة منطق التعامل مع هذه الحالة هنا
                session(['car_data' => 'لا توجد 3 سيارات متاحة في قاعدة البيانات.']);
            }
        
            // عرض البيانات المخزنة في الجلسة (يمكنك طباعة البيانات أو استخدامها في العرض)

        }
        
        
        
        
        


        // إرسال صورة السيارة في الجلسة
        session(['car_picture' => $carImage]);
    
        // في حالة السيارة غير متوفرة أو محجوزة
        return redirect()->route('index')->with('error_message', 'Car is not available for booking at the moment. You may choose another car or check back later.')
                                 ->with('car_picture', session('car_picture'));
    }
    
    
    

    
}
