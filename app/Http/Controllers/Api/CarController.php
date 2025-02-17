<?php

namespace App\Http\Controllers\Api;

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
            'message' => 'Luxury car list retrieved successfully',
            'data' => $cars
        ], 200);
    }


    
    

}
