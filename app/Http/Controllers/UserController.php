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

    public function checkPhoneNumber(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user) {
            $token = $user->createToken('mobile-app')->plainTextToken;

            return response()->json([
                'exists' => true,
                'message' => 'رقم الهاتف موجود بالفعل.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone_number' => $user->phone_number,
                    'email_address' => $user->email_address,
                    'pickup_city' => $user->pickup_city,
                    'created_at' => $user->created_at,
                ],
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'exists' => false,
                'message' => 'رقم الهاتف غير مسجل.'
            ], 404);
        }
    }

public function deleteAccount(Request $request)
{
    $user = $request->user(); // أو auth()->user() لو شغال بـ Sanctum

    if ($user) {
        $user->delete();
        return response()->json(['message' => 'Account deleted successfully'], 200);
    }

    return response()->json(['message' => 'User not found'], 404);
}


public function deleteAccount(Request $request)
{
    $user = $request->user(); // أو auth()->user() لو شغال بـ Sanctum

    if ($user) {
        $user->delete();
        return response()->json(['message' => 'Account deleted successfully'], 200);
    }

    return response()->json(['message' => 'User not found'], 404);
}

}
