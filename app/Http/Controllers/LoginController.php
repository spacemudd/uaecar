<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminUser;  // Make sure to import the AdminUser model if not already

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('back.auth.login'); // Point to your custom login view
    }

    // Handle custom login
    public function login(Request $request)
    {
        // Validate the incoming request
        $credentials = $request->only('email', 'password');

        // Validate email and password
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Attempt to log in using the admin guard
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            // Redirect to the admin dashboard after successful login
            return redirect()->route('admin.dashboard');
        }

        // If login fails, redirect back with error message
        return Redirect::back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();  // Make sure to use the correct guard for admin logout

        // Redirect to the login page after logout
        return redirect()->route('login');
    }
}
