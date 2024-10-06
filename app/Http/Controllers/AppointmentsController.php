<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentsController extends Controller
{
    public function create()
    {
        return Inertia::render('Appointments/Create');
    }

    public function store()
    {
        return redirect()->route('appointments.success');
    }

    public function success()
    {
        return Inertia::render('Appointments/Success');
    }
}
