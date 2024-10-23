<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage; // Ensure you have this model for handling car images
use Illuminate\Http\Request;

class CarsController extends Controller
{
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
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }

    public function store(Request $request)
    {

        dd($request->all());
        // Validate the form input
        $validatedData = $request->validate([
            'node_id' => 'required|string',
            'car_name' => 'required|string',
            'car_model' => 'required|string',
            'car_model_year' => 'required|integer',
            'plate_number' => 'required|string',
            'categories' => 'required|string',
            'seats' => 'required|integer',
            'doors' => 'required|integer',
            'price_daily' => 'required|numeric',
            'price_weekly' => 'required|numeric',
            'price_monthly' => 'required|numeric',
            'car_transmission' => 'required|string',
            'car_description' => 'required|string',
            'chassis_number' => 'nullable|string',
            'color' => 'required|string',
            'car_image' => 'required|image|mimes:jpg,png,jpeg',
            'car_gallery.*' => 'image|mimes:jpg,png,jpeg' // Validate each gallery image
        ]);

        // Handle file upload for car_image
        if ($request->hasFile('car_image')) {
            $imagePath = $request->file('car_image')->store('car_images', 'public');
            $validatedData['car_image'] = $imagePath;
        }

        // Handle gallery images
        $galleryImages = [];
        if ($request->hasFile('car_gallery')) {
            foreach ($request->file('car_gallery') as $galleryImage) {
                $galleryImages[] = $galleryImage->store('car_gallery', 'public');
            }
            $validatedData['car_gallery'] = json_encode($galleryImages);
        }

        // Save car to database
        Car::create($validatedData);

        // Redirect to the cars index with success message
        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }
}
