<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage; // Ensure you have this model for handling car images
use Illuminate\Http\Request;

class CarsController extends Controller
{

    public function toggleVisibility($id)
    {
        $car = Car::findOrFail($id);
        $car->is_visible = !$car->is_visible;
        $car->save();

        return redirect()->back()->with('success', 'Car visibility updated successfully.');
    }

    public function show($id)
    {
        // Load the car with its gallery images
        $car = Car::with('gallery')->findOrFail($id); 
        $images = $car->gallery;
        return view('front.pages.cars.carDetails', compact('car', 'images'));
    }

    public function destroy($id)
    {
        // Find and delete the car by ID
        Car::findOrFail($id)->delete();
        return redirect()->route('admin.carlist')->with('success', 'Car deleted successfully.');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'car_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1886|max:' . date('Y'), // Valid range for car year
            'plate_number' => 'required|string|max:255',
            'categories' => 'nullable|string|max:255',
            'seats' => 'required|integer|min:1|max:100', // Adjust max according to your requirements
            'doors' => 'required|integer|min:1|max:10', // Adjust max according to your requirements
            'color' => 'required|string|max:50',
            'car_price_daily' => 'required|numeric',
            'car_price_weekly' => 'required|numeric',
            'car_price_monthly' => 'required|numeric',
            'gear' => 'required|string|max:50',
            'description' => 'nullable|string',
            'chassis_number' => 'required|string|max:255',
            'is_visible' => 'required|boolean',
            'delivery' => 'required|boolean',
            'kilo_daily' => 'required|integer',
            'kilo_monthly' => 'required|integer',
            'node_system_id' => 'required|integer', // New field validation
            'car_picture' => 'nullable|image', // Validate image file if provided
        ]);
    
        // Create a new car instance
        $car = new Car();
    
        // Assign request values to the car model
        $car->car_name = $request->car_name;
        $car->price_daily = $request->car_price_daily;
        $car->price_weekly = $request->car_price_weekly;
        $car->price_monthly = $request->car_price_monthly;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->plate_number = $request->plate_number;
        $car->categories = $request->categories;
        $car->seats = $request->seats;
        $car->doors = $request->doors;
        $car->color = $request->color;
        $car->gear = $request->gear;
        $car->description = $request->description;
        $car->chassis_number = $request->chassis_number;
        $car->is_visible = $request->is_visible;
        $car->delivery = $request->delivery;
        $car->kilo_daily = $request->kilo_daily;
        $car->kilo_monthly = $request->kilo_monthly;
        $car->node_id = $request->node_system_id; // Assign the new field
    
        if ($request->hasFile('car_picture')) {
            $car->car_picture = $request->file('car_picture')->store('pictures');
        }
    
        // Save the car to the database
        $car->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Car added successfully!');
    }


}
