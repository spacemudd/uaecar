<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class adController extends Controller
{
    public function showAd()
    {
        $ad = Ad::first();
        
        return view('welcome', compact('ad')); 
    }
}
