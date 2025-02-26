<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Car;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all(); 
        return response()->json([
            'status' => true,
            'message' => 'Car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function luxury_cars()
    {
        $cars = Car::where('categories', 'Luxury')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Luxury car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function mid_rang_cars()
    {
        $cars = Car::where('categories', 'Mid Range')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Mid Rang car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function economy_cars()
    {
        $cars = Car::where('categories', 'Economy')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Economy car list retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function sport_cars()
    {
        $cars = Car::where('categories', 'Sports and Exotics')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Sports car list retrieved successfully',
            'data' => $cars
        ], 200);
    }


    public function vans_cars()
    {
        $cars = Car::where('categories', 'Vans and Buses')->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Vans car list retrieved successfully',
            'data' => $cars
        ], 200);
    }



   
    public function authenticate()
    {
        $credentials = [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ];
    
        $response = Http::post('https://luxuria.crs.ae/api/v1/auth/jwt/token', $credentials);
        Log::info('Auth Response:', $response->json());
    
        if ($response->successful()) {
            $token = $response->json()['token'];
            Session::put('auth_token', $token);
            return $token;
        }
    
        return null;
    }
    




    public function getVehicleIdByPlateNumber(Request $request)
    {
        $plateNumber = $request->input('plate_number');
        $token = Session::get('auth_token') ?? $this->authenticate();
    
        if (!$token) {
            return response()->json(['status' => false, 'message' => 'Unauthorized: Authentication failed.'], 401);
        }
    
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get('https://luxuria.crs.ae/api/v1/vehicles');
        Log::info('Vehicle API Response:', $response->json());
    
        if ($response->successful()) {
            $vehicle = collect($response->json()['data'])->firstWhere('plate_number', $plateNumber);
    
            if ($vehicle) {
                return $this->getReservationByVehicleId($vehicle['id']);
            }
    
            return response()->json(['status' => false, 'message' => 'Vehicle not found'], 404);
        }
    
        return response()->json(['status' => false, 'message' => 'Failed to retrieve vehicles', 'error' => $response->json()], $response->status());
    }






    
    
    public function getReservationByVehicleId($vehicleId)
    {
        $token = Session::get('auth_token') ?? $this->authenticate();
    
        if (!$token) {
            return response()->json(['status' => false, 'message' => 'Unauthorized: Authentication failed.'], 401);
        }
    
        $response = Http::withToken($token)->get('https://luxuria.crs.ae/api/v1/vehicles');
    
        if ($response->successful()) {
            $vehicle = collect($response->json()['data'])->firstWhere('id', $vehicleId);
    
            if ($vehicle) {
                if (in_array($vehicle['status'], ['Available', 'Completed', 'Canceled'])) {
                    return $this->createReservation($vehicle);
                }
    
                return response()->json(['status' => false, 'message' => 'The vehicle is not available for booking.'], 403);
            }
    
            return response()->json(['status' => false, 'message' => 'Vehicle not found.'], 404);
        }
    
        return response()->json(['status' => false, 'message' => 'Error retrieving vehicle status: ' . $response->body()], $response->status());
    }
    
    protected function createReservation($vehicle)
    {
        $pickupDate = now()->format('Y-m-d H:i:s'); // تاريخ pickup
        $returnDate = now()->addDays(1)->format('Y-m-d H:i:s'); // تاريخ return
    
        $demoData = [
            'customer_name' => 'Test',
            'customer_nationality' => 'ARE',
            'customer_mobile' => '971501234567',
            'customer_email' => 'test@node.ae',
            'vehicle_id' => $vehicle['id'],
            'vehicle_hint' => 'Toyota Corolla 2013',
            'pickup_date' => $pickupDate,
            'pickup_location' => '71', // استخدم القيمة الصحيحة لموقع الاستلام
            'return_date' => $returnDate,
            'return_location' => '71', // استخدم القيمة الصحيحة لموقع الإرجاع
            'rate_daily' => $vehicle['rate_daily'],
            'status' => 'pending_updates',
        ];
    
        $token = Session::get('auth_token') ?? $this->authenticate();
        $reservationResponse = Http::withToken($token)->post('https://luxuria.crs.ae/api/v1/reservations', $demoData);
    
        if ($reservationResponse->successful()) {
            return response()->json([
                'status' => true,
                'message' => 'Vehicle reserved successfully.',
                'reservation' => $reservationResponse->json(),
            ]);
        }
    
        return response()->json(['status' => false, 'message' => 'Error creating reservation: ' . $reservationResponse->body()], $reservationResponse->status());
    }
    
    

}
