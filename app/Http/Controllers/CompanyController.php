<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function showContact()
    {
        return view("front.pages.contact");
    }
}
