<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store()
    {
        // todo: save email to database.
        return redirect()->to('/');
    }
}
