<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        // Validate the login form data
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user using 'nik' and 'password'
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password], $request->filled('remember'))) {
            // Authentication passed, redirect to the intended page
            return redirect()->intended(route('dashboard'));
        }

        // Authentication failed, return with errors
        throw ValidationException::withMessages([
            'nik' => [trans('auth.failed')],
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
