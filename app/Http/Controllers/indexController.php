<?php

namespace App\Http\Controllers;
use App\Models\Car;

use Illuminate\Http\Request;

class indexController extends Controller
{
    //


    public function showData()
    {
        $cars = Car::orderBy('price_daily', 'desc')->get();
        return view("front.pages.index", compact("cars"));
    }

    public function showVisibleCars()
    {
        $cars = Car::where('is_visible', true)->orderBy('price_daily', 'desc')->get();
        return view("front.pages.index", compact("cars"));
    }

}
