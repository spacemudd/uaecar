<?php

namespace App\Http\Controllers;
use App\Models\Car;

use Illuminate\Http\Request;

class indexController extends Controller
{
    //


    public function showData()
    {
        $cars = Car::all(); // Fetch all cars from the database
        return view("front.pages.index", compact("cars"));
    }
}
