<?php

namespace App\Http\Controllers;
use App\Models\Car;

use Illuminate\Http\Request;

class indexController extends Controller
{
    //


    public function showData()
    {
        $cars = Car::all(); 
        return view("front.pages.index", compact("cars"));
    }

}
