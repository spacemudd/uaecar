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

        session()->flush();
        if (!$car) {
            // إذا كانت السيارة غير موجودة في النظام
            return redirect()->route('index')->with('error_message', 'Car not found in the Node system. Plate number: ' . $plateNumber);
        }
    
        if ($car['status'] == 'Available') {
            session()->flush();

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
    
        // إذا كانت السيارة محجوزة أو في حالة أخرى
        // $token = Cache::get('node_api_token');
    
        // if (!$token) {
        //     $token = $this->authenticate();
        // }
    
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $token
        // ])->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        // if ($response->successful()) {
        //     $vehicles = $response->json();
            
        //     // إذا كانت البيانات متاحة
        //     if (isset($vehicles['data']) && is_array($vehicles['data'])) {
        //         $selectedCarPrice = $request->input('price_daily');
    
        //         $availableCars = array_filter($vehicles['data'], function ($vehicle) use ($selectedCarPrice) {
        //             return isset($vehicle['status']) && $vehicle['status'] === 'Available' &&
        //                 isset($vehicle['price_daily']) &&
        //                 $vehicle['price_daily'] >= ($selectedCarPrice - 100) &&
        //                 $vehicle['price_daily'] <= ($selectedCarPrice + 100);
        //         });
    
        //         if (count($availableCars) < 3) {
        //             $availableCars = array_filter($vehicles['data'], function ($vehicle) {
        //                 return isset($vehicle['status']) && $vehicle['status'] === 'Available';
        //             });
    
        //             shuffle($availableCars);
        //             $availableCars = array_slice($availableCars, 0, 3);
        //         }
    
        //         // جمع أرقام اللوحات وتخزينها في السيشن
        //         $plateNumbers = [];
        //         foreach ($availableCars as $car) {
        //             if (isset($car['plate_number'])) {
        //                 $plateNumbers[] = $car['plate_number']; // إضافة كل رقم لوحة إلى المصفوفة
        //             }
        //         }
    
        //         session(['available_car_plate_numbers' => $plateNumbers]);
    
        //         // إزالة الحروف والأرقام غير الرقمية من أرقام اللوحات المخزنة في السيشن
        //         $cleanedPlateNumbers = array_map(function ($plate) {
        //             return preg_replace('/[^0-9]/', '', $plate); // إزالة أي شيء غير الأرقام
        //         }, $plateNumbers);
    
        //         // الآن لديك أرقام اللوحات فقط بدون الحروف والـ "-"
        //         $existingCars = DB::table('cars')
        //             ->whereIn(DB::raw('REGEXP_REPLACE(plate_number, "[^0-9]", "")'), $cleanedPlateNumbers) // البحث بعد إزالة الحروف والـ "-"
        //             ->get(['id', 'plate_number', 'car_name', 'price_daily', 'car_picture', 'model', 'year']); // إرجاع الـ ID ورقم اللوحة
    
        //         session([
        //             'car-0-name' => $existingCars[0]->car_name,
        //             'car-0-price' => $existingCars[0]->price_daily,
        //             'car-0-image' => $existingCars[0]->car_picture,
        //             'car-0-model' => $existingCars[0]->model,
        //             'car-0-year' => $existingCars[0]->year,
        //             'car-0-id' => $existingCars[0]->id,
        //             'car-1-name' => $existingCars[1]->car_name,
        //             'car-1-price' => $existingCars[1]->price_daily,
        //             'car-1-image' => $existingCars[1]->car_picture,
        //             'car-1-model' => $existingCars[1]->model,
        //             'car-1-year' => $existingCars[1]->year,
        //             'car-1-id' => $existingCars[1]->id,
        //             'car-2-name' => $existingCars[2]->car_name,
        //             'car-2-price' => $existingCars[2]->price_daily,
        //             'car-2-image' => $existingCars[2]->car_picture,
        //             'car-2-model' => $existingCars[2]->model,
        //             'car-2-year' => $existingCars[2]->year,
        //             'car-2-id' => $existingCars[2]->id,
        //         ]);
        //     }
        // }

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

            dd(session('car_data'));
        }
        
        
        
        
        
           

            
        
        



// // استخراج أرقام اللوحات فقط من بيانات الـ API
// $apiPlateNumbers = array_map(function ($car) {
//     return preg_replace('/\D/', '', $car['plate_number']);
// }, $apiCars);

// // الخطوة 3: تصفية المصفوفة للاحتفاظ فقط بالسيارات المطابقة
// $filteredCars = array_filter($luxuryCarsArray, function ($car) use ($apiPlateNumbers) {
//     return in_array($car['plate_number'], $apiPlateNumbers);
// });

// // عرض السيارات المطابقة فقط
// dd($filteredCars);
// } else {
// // معالجة الخطأ إذا فشل الاتصال بالـ API
// return response()->json(['error' => 'Failed to fetch data from API'], 500);
// }


           

        // إرسال صورة السيارة في الجلسة
        $carImage = $request->input('car_picture');
        session(['car_picture' => $carImage]);
    
        // في حالة السيارة غير متوفرة أو محجوزة
        return redirect()->route('index')->with('error_message', 'Car is not available for booking at the moment. You may choose another car or check back later.')
                                 ->with('car_picture', session('car_picture'))
                                 ->with('existing_cars'); 
    }
    
    
    

    
}
