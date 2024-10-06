<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WhyUsController extends Controller
{
    public function index()
    {
        return Inertia::render('WhyUs/Index');
    }
}
