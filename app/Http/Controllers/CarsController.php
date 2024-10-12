<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarsController extends Controller
{
    // public function index()
    // {
    //     $cars = Car::with('media')->where('at_published', 'PUBLISHED')->get();
    //     return Inertia::render('Cars/Index', [
    //         'cars' => $cars,
    //     ]);
    // }

    public function show($id)
    {
        
        $car = Car::with('gallery')->findOrFail($id); // Use 'gallery' instead of 'CarImage'
        $images = $car->gallery; // Get the related images
        return view('front.pages.cars.carDetails', compact('car', 'images'));
    }

    public function destroy($id)
    {
        Car::find($id)->delete();
        return redirect()->route('cars.index');
    }
}
