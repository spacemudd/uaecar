<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

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



    public function reserveCar(Request $request)
    {
        $plate_number = $request->input('plate_number');
        $pickup_date = $request->input('pickup_date');
        $return_date = $request->input('return_date');
    
        $response = Http::post('https://demo.crs.ae/api/v1/auth/jwt/token', [
            'username' => 'info@rentluxuria.com',
            'password' => ')ixLj(CQYSE84MRMqm*&dega',
        ]);
    
        if ($response->successful()) {
            $token = $response->json()['token']; 
            
    
            return response()->json([
                'plate_number' => $plate_number,
                'pickup_date' => $pickup_date,
                'return_date' => $return_date,
                'token' => $token, 
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login failed',
                'error' => $response->json(),
            ], 401);
        }
    }
    



    
    

}
