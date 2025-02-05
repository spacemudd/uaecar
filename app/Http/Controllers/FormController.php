<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NodeSystemException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Carbon\Carbon;




class FormController extends Controller
{

public function submit(Request $request)
{
    session('new_id', $request->input('car_id'));
    $plateNumber = $request->input('plate_number');
    $plateNumber = preg_replace('/^(?:[A-Z]-|CC-)/', '', $plateNumber);    
    $token = $this->getAuthToken();
    
    $car = $this->getCarDetailsByPlateNumber($plateNumber, $token);
    
    // Check if 'booking_duration' is Weekly, Monthly, or Daily
    if ($request->input('booking_duration') == 'Weekly') {
        // Ensure pickup_date exists and parse it
        if ($request->has('pickup_date')) {
            // Parse the pickup_date and add 6 days
            $pickupDate = Carbon::parse($request->input('pickup_date'));
            $returnDate = $pickupDate->addDays(7);
            session(['return_date'=>$returnDate]);
        } else {
            // Handle case where pickup_date is missing
            $returnDate = null; // Or handle accordingly
        }
    } elseif ($request->input('booking_duration') == 'Monthly') {
        // If booking_duration is Monthly, add 30 days
        if ($request->has('pickup_date')) {
            // Parse the pickup_date and add 30 days
            $pickupDate = Carbon::parse($request->input('pickup_date'));
            $returnDate = $pickupDate->addDays(30);
            session(['return_date'=>$returnDate]);
        } else {
            // Handle case where pickup_date is missing
            $returnDate = null; // Or handle accordingly
        }
    } elseif ($request->input('booking_duration') == 'Daily') {
        // If booking_duration is Daily, use the return_date input directly
        if ($request->has('return_date')) {
            $returnDate = Carbon::parse($request->input('return_date'));
            session(['return_date'=>$returnDate]);
        } else {
            // Handle case where return_date is missing
            $returnDate = null; // Or handle accordingly
        }
    } else {
        $returnDate = null; // Handle other booking durations if needed
    }
    
    // You can now pass $returnDate to the response if needed
    return $this->respondCarStatus($car, $plateNumber, $request, $returnDate);
    
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
        // $reservationResponse = Http::withHeaders([
        //     'Authorization' => "Bearer $token"
        // ])->get('https://luxuria.crs.ae/api/v1/reservations/');
    
        // if (!$reservationResponse->successful()) {
        //     throw new NodeSystemException('Failed to communicate with the Reservations API.');
        // }
    
        // $reservations = $reservationResponse->json()['data'];
    
        // foreach ($reservations as $reservation) {
        //     // التحقق إذا كانت السيارة محجوزة ومؤكدة
        //     if ($reservation['status'] === 'Confirmed' && isset($reservation['vehicle_hint'])) {
        //         $plateNumber = preg_replace('/[^0-9]/', '', $reservation['vehicle_hint']); // استخراج رقم اللوحة
    
        //         // البحث عن السيارة في قاعدة البيانات باستخدام رقم اللوحة
        //         $carFromDatabase = DB::table('cars')
        //             ->where(DB::raw("REGEXP_REPLACE(plate_number, '[^0-9]', '')"), $plateNumber)
        //             ->first();
    
        //         if ($carFromDatabase) {
        //             // إذا تم العثور على السيارة في قاعدة البيانات
        //             $carData = [
        //                 'car_name' => $carFromDatabase->car_name,
        //                 'price_daily' => $carFromDatabase->price_daily,
        //                 'model' => $carFromDatabase->model,
        //                 'car_picture' => $carFromDatabase->car_picture,
        //             ];
    
        //             // حفظ بيانات السيارة في الجلسة
        //             session(['car_reserved' => true]);
        //             session(['reserved_car_data' => $carData]);
    
        //             // إرجاع رسالة بأن السيارة محجوزة مع بيانات السيارة
        //             return redirect()->route('index')
        //                 ->with('success_message', 'This car is confirmed reserved. Here are the car details.')
        //                 ->with('car_details', $carData);
        //         }
        //     }
        // }
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
        
        $token = Cache::get('node_api_token') ?? $this->authenticate();

    
        // إذا كانت السيارة غير موجودة أو غير متوفرة
        if (!$car || $car['status'] !== 'Available') {
            // جلب جميع السيارات من API
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
    
                // إذا كانت هناك 3 سيارات على الأقل
                
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

            // إرسال صورة السيارة الحالية مع الرسالة
            session(['car_picture' => $carImage]);
    
            return redirect()->route('index')
                ->with('error_message', 'Car is not available for booking at the moment. Please check the available options below.')
                ->with('car_picture', session('car_picture'))
                ->with('car_data', session('car_data')); // تمرير البيانات للـ View
        }else{
        // إذا كانت السيارة متوفرة
        session([
            'pickup_date' => $request->input('pickup_date'),
            'return_date' => $request->input('return_date'),

            'rate_daily' => $request->input('price_daily'),
            'rate_weekly' => $request->input('price_weekly'),
            'rate_monthly' => $request->input('price_monthly'),
            'pickup_location' => '71', // Static value
            'return_location' => '71', // Static value
            'status' => 'pending_updates',
            'booking_duration' => $request->input('booking_duration'),
            'vehicle_hint' => $request->input('carName'),
            'customer_name' => $request->input('name'),
            'customer_mobile' => $request->input('phone'),
            'customer_email' => $request->input('email'),
            'pickup_city' => $request->input('pickup_city'),
            'car_image' => $car['image_url'] ?? null,
            'new_id' => $request->input('car_id'),
            'car_name' => $request->input('car_name'),
        ]);
    
        return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }
    

    }



    public function sendContactEmail(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Prepare the data for the email
        $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);

        // Send the email using ContactMail
        Mail::to('support@rentluxuria.com')->send(new ContactMail($data));

        // Provide a response or redirect
        return back()->with('success', 'Your message has been sent successfully!');
    }
    

    
}
