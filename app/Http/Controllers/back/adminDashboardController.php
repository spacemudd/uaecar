<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminDashboardController extends Controller
{
    //

    public function index(){
        return view('back.pages.dashboard');
    }
}
