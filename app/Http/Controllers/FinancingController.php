<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FinancingController extends Controller
{
    public function index()
    {
        return Inertia::render('Financing/Index');
    }
}
