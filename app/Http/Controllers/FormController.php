<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NodeSystemException;
use Illuminate\Support\Facades\Log;


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
        $password = 'B!2plF@t9psJOiZCd9AVRC#o';

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
            return response()->json([
                'success' => false,
                'message' => 'Car not found in the Node system. Plate number: ' . $plateNumber
            ]);
        }
    
        if ($car['status'] === 'Available') {
            session([
                'pickup_date' => $request->input('pickup_date'),  // Get from request
                'return_date' => $request->input('return_date'),  // Get from request
                'rate_daily' => $request->input('price_daily'),  // Get from request
                'pickup_location' => '71',  // Static value
                'return_location' => '71',  // Static value
                'status' => 'pending_updates',  // Static value or dynamic from car
                'vehicle_hint' => $request->input('carName'),  // Get from request
                'customer_name' => $request->input('name'),  // Get from request
                'customer_mobile' => $request->input('phone'),  // Get from request
                'customer_email' => $request->input('email'),  // Get from request
                'car_id' => $request->input('car_id'),  // Store car_id for later use
                'pickup_city' => $request->input('pickup_city'),
            ]);
            
            return redirect()->route('cars.checkout', ['id' => $request->input('car_id')]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Car is not available for booking at the moment.'
        ]);
    }
    
    


    private function reserveCar($car, $request, $token)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $token",
            'Content-Type' => 'application/json'
        ])->post('https://luxuria.crs.ae/api/v1/reservations', [
            'pickup_date' => $request->input('pickup_date'),  // Get from request
            'return_date' => $request->input('return_date'),  // Get from request
            'rate_daily' => $request->input('price_daily'),  // Get from request
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
