<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage; // Ensure you have this model for handling car images
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
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
            'seats' => 'required|integer',
            'price_daily' => 'required|numeric',
            'price_weekly' => 'required|numeric',
            'price_monthly' => 'required|numeric',
            'car_picture' => 'nullable|image',
            'year' => 'required|integer',
            'plate_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'car_gallery.*' => 'nullable|image',
            'chassis_number' => 'nullable|string|max:255',
            'kilo_daily' => 'required|integer', // Validate kilo daily // Add validation for chassis number // Validate multiple images
            'kilo_monthly' => 'required|integer', // Validate kilo daily // Add validation for chassis number // Validate multiple images
            'node_system_id' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'gear' => 'nullable|string|max:50',
            'doors' => 'required|integer',
            'categories' => 'required|string|in:Luxury,Premium,Economy,Sports,Vans', // إضافة التحقق للفئة // Add validation for gear
             // Add validation for color // Add validation for node_system_id

        ]);
        
        // Create a new car instance
        $car = new Car();
    
        // Assign request values to the car model
        $car->car_name = $request->car_name;
        $car->model = $request->model;
        $car->seats = $request->seats;
        $car->price_daily = $request->price_daily;
        $car->price_weekly = $request->price_weekly;
        $car->price_monthly = $request->price_monthly;
        $car->year = $request->year;
        $car->plate_number = $request->plate_number;
        $car->description = $request->description;
        $car->chassis_number = $request->chassis_number;
        $car->kilo_daily = $request->kilo_daily;
        $car->kilo_monthly = $request->kilo_monthly;
        $car->node_id = $request->node_system_id; 
        $car->color = $request->color;
        $car->gear = $request->gear;
        $car->categories = $request->categories;
        $car->doors = $request->doors; // Add this line // Add this line to update the gear // Add this line to update the color
        // Save node_system_id
        // Save kilo daily
         // Save chassis number
    
    
        if ($request->hasFile('car_picture')) {
            $car->car_picture = $request->file('car_picture')->store('car_images', 'public'); // Store in public disk
        }
    
        // Save the car to the database
        $car->save();
    
        if ($request->hasFile('car_gallery')) {
            foreach ($request->file('car_gallery') as $image) {
                $path = $image->store('car_images', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                ]);
            }
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Car added successfully!');
    }
    



    public function edit($id)
    {
        $car = Car::findOrFail($id); // Get the car
        $images = $car->gallery;
    
        $categoryValue = $car->categories; 
    

        $colors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Gray'];

        $currentColor = $car->color; 



        return view('back.pages.edit', compact('car', 'images', 'categoryValue', 'colors', 'currentColor'));
    }
    
    
    
    


    public function update(Request $request, $id)
    {        // Validate the request
        $request->validate([
            'node_system_id' => 'nullable|string|max:255', // Add validation for node_system_id
            'car_name' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'seats' => 'nullable|integer',
            'price_daily' => 'nullable|numeric',
            'price_weekly' => 'nullable|numeric',
            'price_monthly' => 'nullable|numeric',
            'car_picture' => 'nullable|image',
            'year' => 'nullable|integer',
            'plate_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'car_gallery.*' => 'nullable|image',
            'chassis_number' => 'nullable|string|max:255',
            'kilo_daily' => 'nullable|integer', // Validate kilo daily // Add validation for chassis number // Validate multiple images
            'kilo_monthly' => 'nullable|integer',
            'categories' => 'nullable|string|in:Luxury,Mid Range,Economy, Vans and Buses,Sports and Exotics', // Updated
            'color' => 'nullable|string|in:Red,Blue,Green,Black,White,Gray', // Updated
             // Validate kilo daily // Add validation for chassis number // Validate multiple images
            'doors' => 'nullable|integer|min:2|max:5', // New validation for doors
        ]);
    
        // Find the car by ID
        $car = Car::findOrFail($id);
    
        // Update car details
        $car->car_name = $request->car_name;
        $car->model = $request->model;
        $car->seats = $request->seats;
        $car->price_daily = $request->price_daily;
        $car->price_weekly = $request->price_weekly;
        $car->price_monthly = $request->price_monthly;
        $car->year = $request->year;
        $car->plate_number = $request->plate_number;
        $car->description = $request->description;
        $car->chassis_number = $request->chassis_number;
        $car->kilo_daily = $request->kilo_daily;
        $car->kilo_monthly = $request->kilo_monthly;
        $car->node_id = $request->node_system_id;
        $car->categories = $request->categories;
        $car->color = $request->color;
        $car->doors = $request->doors; // Save node_system_id
        // Save kilo daily
         // Save chassis number
    
        // Handle car image upload
        if ($request->hasFile('car_picture')) {
            $car->car_picture = $request->file('car_picture')->store('car_images', 'public'); // Store in public disk
        }
      

     
        // Save the car details
        $car->save();
    

        if($request->hasFile('car_gallery')){
            foreach($request->file('car_gallery') as $image) {
                $path = $image->store('car_images', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                ]);
            }
        }
        
    
        // Optionally return a response or redirect
        return redirect()->route('admin.carlist', $car->id)->with('success', 'Car updated successfully!');
    }


    public function deleteGalleryImage($id)
{
    $image = CarImage::findOrFail($id);
    Storage::disk('public')->delete($image->image_path); // Delete the image file
    $image->delete(); // Delete the record from the database

    return redirect()->back()->with('success', 'Image deleted successfully.');
}





// public function showAd()
// {
//     $ad = Ad::first();
    
//     return view('welcome', compact('ad')); 
// }

    

}
