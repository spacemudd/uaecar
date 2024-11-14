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
        $password = 'N^9SHXvCLzVbP(Ild(PI9sqP';

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
            // Get the daily price and the number of days selected by the user
            $priceDaily = $request->input('price_daily');  // Price per day
            $pickupDate = $request->input('pickup_date');  // Pickup date
            $returnDate = $request->input('return_date');  // Return date
    
            // Calculate the number of days
            $pickup = \Carbon\Carbon::parse($pickupDate);
            $return = \Carbon\Carbon::parse($returnDate);
            $daysDifference = $pickup->diffInDays($return); // Get the number of days between pickup and return
    
            // Calculate total price
            $totalPrice = $priceDaily * $daysDifference;
    
            // Get car details to pass to payment page
            $carName = $request->input('carName'); 
    
            // Return payment link directly with car details
            return redirect()->route('stripe.payment', [
                'total_price' => $totalPrice,
                'car_name' => $carName,
                'price_daily' => $priceDaily,
                'pickup_date' => $pickupDate,
                'return_date' => $returnDate
            ]);
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
