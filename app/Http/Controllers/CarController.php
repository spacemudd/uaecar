<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage; // Ensure you have this model for handling car images
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;

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
            'car_picture' => 'nullable|image',
            'car_gallery.*' => 'nullable|image|max:2048', // Validate multiple images

            // 'car_gallery.*' => 'nullable|image', // Adjusted to validate multiple images
            // Validate image file if provided
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
            $car->car_picture = $request->file('car_picture')->store('car_images', 'public'); // Store in public disk
        }

        
    
        // Save the car to the database
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
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Car added successfully!');
    }


    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $images = $car->gallery;

        return view('back.pages.edit', compact('car', 'images'));
    }


    public function update(Request $request, $id)
    {        // Validate the request
        $request->validate([
            'car_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'seats' => 'required|integer',
            'price_daily' => 'required|numeric',
            'price_weekly' => 'required|numeric',
            'price_monthly' => 'required|numeric',
            'car_picture' => 'nullable|image',
            'year' => 'required|integer',
            'plate_number' => 'required|string|max:255',
            'description' => 'nullable|string',
            'car_gallery.*' => 'nullable|image|max:2048', // Validate multiple images

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
    
        // Handle car image upload
        if ($request->hasFile('car_picture')) {
            $car->car_picture = $request->file('car_picture')->store('car_images', 'public'); // Store in public disk
        }
        

        // if ($request->hasFile('car_gallery')) {
        //     // Optional: Clear previous gallery images if needed
    
        //     foreach ($request->file('car_gallery') as $image) {
        //         // Store each image and create a new CarImage record
        //         $path = $image->store('car_images', 'public');
    
        //         // Save the image path in the car_gallery table
        //         CarImage::create([
        //             'car_id' => $car->id,
        //             'image_path' => $path,
        //         ]);
        //     }
        // }

      

     
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
        $image = CarImage::findOrFail($id); // Find the image by ID
        Storage::disk('public')->delete($image->image_path); // Delete the image file from storage
        $image->delete(); // Delete the record from the database
    
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
    

    

}
