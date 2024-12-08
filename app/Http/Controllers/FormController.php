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
        $plateNumber = $request->input('plate_number');
        $plateNumber = preg_replace('/^[A-B]-/', '', $plateNumber);
    
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
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        if (!$response->successful()) {
            throw new NodeSystemException('Failed to communicate with the Node system.');
        }
    
        $vehicles = $response->json()['data'];
    
        return collect($vehicles)->firstWhere('plate_number', $plateNumber);
    }
    

    private function respondCarStatus($car, $plateNumber, $request)
    {
        if (!$car) {
            // تخزين الرسالة في سيشن باسم مختلف
            return redirect()->back()->with('node_error_message', 'Car not found in the Node system. Plate number: ' . $plateNumber);
        }
        
        
    
        if ($car['status'] === 'Available') {
            // Store car details in session
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
                'car_id' => $request->input('car_id'),
                'pickup_city' => $request->input('pickup_city'),
                'car_image' => $car['image_url'] ?? null,  // Assuming image_url exists in car data
            ]);
    
            // Optionally, you can redirect to the checkout page here
            // return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }
    
        // Proceed with fetching other available cars
        $token = Cache::get('node_api_token');

        if (!$token) {
            $token = $this->authenticate();
        }
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');
        
        if ($response->successful()) {
            $vehicles = $response->json();
        
            if (isset($vehicles['data']) && is_array($vehicles['data'])) {
                $selectedCarPrice = $request->input('price_daily');
        
                $availableCars = array_filter($vehicles['data'], function ($vehicle) use ($selectedCarPrice) {
                    return isset($vehicle['status']) && $vehicle['status'] === 'Available' &&
                        isset($vehicle['price_daily']) &&
                        $vehicle['price_daily'] >= ($selectedCarPrice - 100) &&
                        $vehicle['price_daily'] <= ($selectedCarPrice + 100);
                });
        
                if (count($availableCars) < 3) {
                    $availableCars = array_filter($vehicles['data'], function ($vehicle) {
                        return isset($vehicle['status']) && $vehicle['status'] === 'Available';
                    });
        
                    shuffle($availableCars);
                    $availableCars = array_slice($availableCars, 0, 3);
                }
        
                // Collect plate numbers and save them to session
                $plateNumbers = [];
                foreach ($availableCars as $car) {
                    if (isset($car['plate_number'])) {
                        $plateNumbers[] = $car['plate_number']; // Add each plate number to the array
                    }
                }
        
                // Save plate numbers in session
                session(['available_car_plate_numbers' => $plateNumbers]);
              // فرضًا أن المتغير $plateNumbers يحتوي على الأرقام المحفوظة في السيشن
                $plateNumbers = session('available_car_plate_numbers');


                // قم بإزالة الحروف والـ "-" من الأرقام المخزنة في السيشن
                $cleanedPlateNumbers = array_map(function($plate) {
                    return preg_replace('/[^0-9]/', '', $plate); // إزالة أي شيء غير الأرقام
                }, $plateNumbers);

                // الآن لديك أرقام اللوحات فقط بدون الحروف والـ "-"
                $existingCars = DB::table('cars')
                ->whereIn(DB::raw('REGEXP_REPLACE(plate_number, "[^0-9]", "")'), $cleanedPlateNumbers) // البحث بعد إزالة الحروف والـ "-"
                ->get(['id', 'plate_number', 'car_name', 'price_daily', 'car_picture', 'model', 'year']); // إرجاع الـ ID ورقم اللوحة
                
            
                session([
                    'car-0-name' => $existingCars[0]->car_name,
                    'car-0-price' => $existingCars[0]->price_daily,
                    'car-0-image' => $existingCars[0]->car_picture,
                    'car-0-model' => $existingCars[0]->model,
                    'car-0-year' => $existingCars[0]->year,
                    'car-0-id' => $existingCars[0]->id,
                    'car-1-name' => $existingCars[1]->car_name,
                    'car-1-price' => $existingCars[1]->price_daily,
                    'car-1-image' => $existingCars[1]->car_picture,
                    'car-1-model' => $existingCars[1]->model,
                    'car-1-year' => $existingCars[1]->year,
                    'car-1-id' => $existingCars[1]->id,
                    'car-2-name' => $existingCars[2]->car_name,
                    'car-2-price' => $existingCars[2]->price_daily,
                    'car-2-image' => $existingCars[2]->car_picture,
                    'car-2-model' => $existingCars[2]->model,
                    'car-2-year' => $existingCars[2]->year,
                    'car-2-id' => $existingCars[2]->id,
                ]);


        
                // Optionally, you can dump the existing cars to verify
                // dd($existingCars); // Uncomment this line to debug
        
                // You now have the list of cars that match the plate numbers in $existingCars
            }
        }
        
        $carImage = $request->input('car_picture'); // هذا سيأتي من الفورم
        session(['car_picture' => $carImage]);
        dd(session('car_picture'));


        
        return redirect()->back()->with('error_message', 'Car is not available for booking at the moment. You may choose another car or check back later.')
                                 ->with('car_picture', session('car_picture')); 
                                 -with('existing_cars', $existingCars); // إرسال صورة السيارة في الجلسة
        
    }
    
    


    public function reserveCar($car, $request, $token)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $token",
            'Content-Type' => 'application/json'
        ])->post('https://luxuria.crs.ae/api/v1/reservations', [
            'pickup_date' => $request->input('pickup_date'),  
            'return_date' => $request->input('return_date'),  
            'rate_daily' => $request->input('price_daily'),  
            'pickup_location' => '71',  // Static value
            'return_location' => '71',  // Static value
            'status' => 'pending_updates',  // Dynamic value from the car data
            'vehicle_hint' => $request->input('carName'),  // Dynamic value from the car data
            'customer_name' =>$request->input('name'),
            'customer_mobile' => $request->input('phone'),
            'customer_email' => $request->input('email'),
        ]);
    }

    
}
