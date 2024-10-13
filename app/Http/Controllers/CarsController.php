<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarsController extends Controller
{


    public function show($id)
    {
        
        $car = Car::with('gallery')->findOrFail($id); 
        $images = $car->gallery;
        return view('front.pages.cars.carDetails', compact('car', 'images'));
    }

    public function destroy($id)
    {
        Car::find($id)->delete();
        return redirect()->route('cars.index');
    }
}
