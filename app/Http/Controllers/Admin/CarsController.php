<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::get();
        return Inertia::render('Admin/Cars/Index', [
            'cars' => $cars,
        ]);
    }

    public function show($id)
    {
        return Inertia::render('Admin/Cars/Show', [
            'car' => Car::with('media')->findOrFail($id),
        ]);
    }

    public function upload($id)
    {
        $car = Car::find($id);
        $car->addMediaFromRequest('car_image')
            ->usingFileName(request()->file('car_image')->hashName())
            ->toMediaCollection('car_images');

        return redirect()->route('admin.cars.show', $id);
    }
}
