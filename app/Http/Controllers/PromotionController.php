<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;


class PromotionController extends Controller
{
    public function index(){

       $cars = Car::all();


        return view('front.pages.ndp',compact("cars"));
    }
}
