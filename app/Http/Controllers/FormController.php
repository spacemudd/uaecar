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
        if (!$car) {
            return redirect()->back()->with('node_error_message', 'Car not found in the Node system. Plate number: ' . $plateNumber);
        }
    
        if ($car['status'] == 'Available') {
            session()->flush();
    
            session([
                'pickup_date' => $request->input('pickup_date'),
                'return_date' => $request->input('return_date'),
                'rate_daily' => $request->input('price_daily'),
                'pickup_location' => '71',
                'return_location' => '71',
                'status' => 'pending_updates',
                'vehicle_hint' => $request->input('carName'),
                'customer_name' => $request->input('name'),
                'customer_mobile' => $request->input('phone'),
                'customer_email' => $request->input('email'),
                'pickup_city' => $request->input('pickup_city'),
                'car_image' => $car['image_url'] ?? null,
                'new_id' => $request->input('car_id')
            ]);
    
            return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }
    
        $luxuryCars = Car::where('categories', 'Luxury')
            ->get(['id', 'plate_number', 'price_daily', 'car_name', 'model', 'year', 'car_picture'])
            ->toArray();
        array_walk($luxuryCars, fn(&$car) => $car['plate_number'] = preg_replace('/\D/', '', $car['plate_number']));
    
        $token = Cache::get('node_api_token') ?: $this->authenticate();
    
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        if ($response->successful()) {
            $apiPlateNumbers = array_map(fn($car) => preg_replace('/\D/', '', $car['plate_number']),
                array_filter($response->json()['data'], fn($car) => $car['status'] === 'Available')
            );
    
            $updatedLuxuryCars = array_filter($luxuryCars, fn($car) => in_array($car['plate_number'], $apiPlateNumbers));
    
            $carWithLowestPrice = array_reduce($updatedLuxuryCars, fn($lowestCar, $car) => ($lowestCar === null || $car['price_daily'] < $lowestCar['price_daily']) ? $car : $lowestCar);
    
            $midRangeCars = Car::where('categories', 'Mid Range')
                ->get(['id', 'plate_number', 'price_daily', 'car_name', 'model', 'year', 'car_picture'])
                ->toArray();
            array_walk($midRangeCars, fn(&$car) => $car['plate_number'] = preg_replace('/\D/', '', $car['plate_number']));
    
            $economyCars = Car::where('categories', 'Economy')
                ->get(['id', 'plate_number', 'price_daily', 'car_name', 'model', 'year', 'car_picture'])
                ->toArray();
            array_walk($economyCars, fn(&$car) => $car['plate_number'] = preg_replace('/\D/', '', $car['plate_number']));
    
            $updatedMidRangeCars = array_filter($midRangeCars, fn($car) => in_array($car['plate_number'], $apiPlateNumbers));
            $carWithLowestMidRangePrice = array_reduce($updatedMidRangeCars, fn($lowestCar, $car) => ($lowestCar === null || $car['price_daily'] < $lowestCar['price_daily']) ? $car : $lowestCar);
    
            $updatedEconomyCars = array_filter($economyCars, fn($car) => in_array($car['plate_number'], $apiPlateNumbers));
            $carWithLowestEconomyPrice = array_reduce($updatedEconomyCars, fn($lowestCar, $car) => ($lowestCar === null || $car['price_daily'] < $lowestCar['price_daily']) ? $car : $lowestCar);
    
            $carCategories = [
                'luxury' => $carWithLowestPrice,
                'mid-range' => $carWithLowestMidRangePrice,
                'economy' => $carWithLowestEconomyPrice,
            ];
    
            $carImage = $request->input('car_picture');
            session(['car_picture' => $carImage]);
    
            $redirect = redirect()->route('index')
                ->with('error_message', 'Car is not available for booking at the moment. You may choose another car or check back later.')
                ->with('car_picture', session('car_picture'));
    
            foreach ($carCategories as $category => $carData) {
                $redirect = $redirect
                    ->with("car-{$category}-picture", $carData['car_picture'])
                    ->with("car-{$category}-name", $carData['car_name'])
                    ->with("car-{$category}-model", $carData['model'])
                    ->with("car-{$category}-year", $carData['year'])
                    ->with("car-{$category}-price", $carData['price_daily']);
            }
    
            return $redirect;
        }
    }
}    