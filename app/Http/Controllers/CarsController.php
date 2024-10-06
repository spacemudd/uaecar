<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::with('media')->where('at_published', 'PUBLISHED')->get();
        return Inertia::render('Cars/Index', [
            'cars' => $cars,
        ]);
    }

    public function show($id)
    {
        return Inertia::render('Cars/Show', [
            'car' => Car::where('at_published', 'PUBLISHED')->with('media')->findOrFail($id),
        ]);
    }

    public function destroy($id)
    {
        Car::find($id)->delete();
        return redirect()->route('cars.index');
    }
}
