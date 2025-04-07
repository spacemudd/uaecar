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
        
        if ($request->input('booking_duration') == 'Weekly') {
            if ($request->has('pickup_date')) {
                $pickupDate = Carbon::parse($request->input('pickup_date'));
                $returnDate = $pickupDate->addDays(7);
                session(['return_date'=>$returnDate]);
            } else {
                $returnDate = null;
            }
        } elseif ($request->input('booking_duration') == 'Monthly') {
            if ($request->has('pickup_date')) {
                $pickupDate = Carbon::parse($request->input('pickup_date'));
                $returnDate = $pickupDate->addDays(30);
                session(['return_date'=>$returnDate]);
            } else {
                $returnDate = null;
            }
        } elseif ($request->input('booking_duration') == 'Daily') {
            if ($request->has('return_date')) {
                $returnDate = Carbon::parse($request->input('return_date'));
                session(['return_date'=>$returnDate]);
            } else {
                $returnDate = null;
            }
        } else {
            $returnDate = null;
        }
        
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
        $vehicleListResponse = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        if (!$vehicleListResponse->successful()) {
            throw new NodeSystemException('Failed to communicate with the Node system.');
        }
    
        $vehicles = $vehicleListResponse->json()['data'];
        return collect($vehicles)->firstWhere('plate_number', $plateNumber);
    }

    private function respondCarStatus($car, $plateNumber, $request)
    {
        $carImage = $request->input('car_picture');
        $token = Cache::get('node_api_token') ?? $this->authenticate();

        if (!$car || $car['status'] !== 'Available') {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('https://luxuria.crs.ae/api/v1/vehicles');
        
            if ($response->successful()) {
                $apiCars = $response->json()['data'];
        
                // ابحث عن السيارة باستخدام الاسم والموديل والسنة
                $carName = $car['make'];
                $model = $car['model'];
                $year = $car['year'];
        
                $matchedCars = collect($apiCars)->filter(function ($vehicle) use ($carName, $model, $year) {
                    return str_contains($vehicle['make'], $carName) && 
                           str_contains($vehicle['model'], $model) && 
                           $vehicle['year'] == $year && 
                           $vehicle['status'] === 'Available'; // تحقق من أن الحالة "Available"
                });

                if ($matchedCars->isNotEmpty()) {
                    // يمكنك هنا متابعة عملية الحجز
                    // على سبيل المثال، حفظ تفاصيل الحجز في الجلسة أو قاعدة البيانات
        
                    // مثال على كيفية حفظ تفاصيل الحجز
                    session(['matched_cars' => $matchedCars->toArray()]);
                    session([
                        'pickup_date' => $request->input('pickup_date'),
                        'return_date' => $request->input('return_date'),
                        'rate_daily' => $request->input('price_daily'),
                        'rate_weekly' => $request->input('price_weekly'),
                        'rate_monthly' => $request->input('price_monthly'),
                        'pickup_location' => '71',
                        'return_location' => '71',
                        'status' => 'pending_updates',
                        'booking_duration' => $request->input('booking_duration'),
                        'vehicle_hint' => $request->input('carName'),
                        'customer_name' => $request->input('name'),
                        'customer_mobile' => $request->input('phone'),
                        'customer_email' => $request->input('email'),
                        'customer_address' => $request->input('pickup_city'),
                        'pickup_city' => $request->input('pickup_city'),
                        'car_image' => $car['image_url'] ?? null,
                        'new_id' => $request->input('car_id'),
                        'car_name' => $request->input('car_name'),
                        'plate_number' => $matchedCars->first()['plate_number'], // تسجيل رقم لوحة السيارة المتاحة
                    ]);
        
                    return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
                }
        
                // إذا تم العثور على السيارة المطابقة، اطبع البيانات باستخدام dd
        
                $availableCars = collect($apiCars)->filter(function ($car) {
                    return isset($car['status']) && $car['status'] === 'Available';
                });
        
                $plateNumbers = $availableCars->pluck('plate_number')->map(function ($plate) {
                    return preg_replace('/[^0-9]/', '', $plate);
                });
        
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
            } else {
                throw new NodeSystemException('Failed to communicate with the Node system.');
            }
        
            session(['car_picture' => $carImage]);
            return redirect()->route('index')
                ->with('error_message', 'Car is not available for booking at the moment. Please check the available options below.')
                ->with('car_picture', session('car_picture'))
                ->with('car_data', session('car_data'));
        }
         else {
            session([
                'pickup_date' => $request->input('pickup_date'),
                'return_date' => $request->input('return_date'),
                'rate_daily' => $request->input('price_daily'),
                'rate_weekly' => $request->input('price_weekly'),
                'rate_monthly' => $request->input('price_monthly'),
                'pickup_location' => '71',
                'return_location' => '71',
                'status' => 'pending_updates',
                'booking_duration' => $request->input('booking_duration'),
                'vehicle_hint' => $request->input('carName'),
                'customer_name' => $request->input('name'),
                'customer_mobile' => $request->input('phone'),
                'customer_email' => $request->input('email'),
                'customer_address' => $request->input('pickup_city'),
                'pickup_city' => $request->input('pickup_city'),
                'car_image' => $car['image_url'] ?? null,
                'new_id' => $request->input('car_id'),
                'car_name' => $request->input('car_name'),
                'plate_number' => $request->input('plate_number'),
            ]);
    
            return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }
    }

    public function sendContactEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);
        Mail::to('support@rentluxuria.com')->send(new ContactMail($data));
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
