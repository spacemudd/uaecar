<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CategoryController extends Controller
{
    public function showLuxury(){
        $cars = Car::orderBy('price_daily', 'desc')->get();

        return view('front.pages.cars.luxury', compact('cars'));
    }


    public function showPremium(){
        $cars = Car::orderBy('price_daily', 'desc')->get();

        return view('front.pages.cars.premium', compact('cars'));
    }

    public function showEconomy(){
        $cars = Car::orderBy('price_daily', 'desc')->get();

        return view('front.pages.cars.economy', compact('cars'));
    }
}
