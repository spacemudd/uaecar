<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class adminDashboardController extends Controller
{
    //

    public function index(){

        $car_count = Car::count();
        return view('back.pages.dashboard', compact('car_count'));
    }


    public function addCars(){
        return view('back.pages.addcars');
    }

    public function showCarList(){

        $cars = Car::all(); 

        return view('back.pages.carlist', compact("cars"));
    }
}
