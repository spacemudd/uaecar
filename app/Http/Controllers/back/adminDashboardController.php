<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class adminDashboardController extends Controller
{
    //

    public function index(){
        return view('back.pages.dashboard');
    }


    public function addCars(){
        return view('back.pages.addcars');
    }

    public function showCarList(){

        $cars = Car::all(); 

        return view('back.pages.carlist', compact("cars"));
    }
}
