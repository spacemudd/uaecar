<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email_address' => 'required|string|email|max:255|unique:users',
            'pickup_city' => 'required|string|max:255',
        ]);

        $user = User::create($request->all());

        return response()->json($user, 201);
    }
}
