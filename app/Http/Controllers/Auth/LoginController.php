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
            \Log::info('Login Berhasil');
            // Authentication passed, redirect to the intended page
            if (Auth::check()) {
                $role = Auth::user()->role_id;

                // Redirect based on user role
                if ($role == 1) {
                    return redirect()->route('admin.index');  // Admin page
                } elseif ($role == 2) {
                    return redirect()->route('dosen.page')->with('user', Auth::user());   // Dosen page
                } else {
                    return redirect()->route('user.page');    // User page
                }
            }

            // If not authenticated, redirect to login page
            return redirect()->route('login');
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
