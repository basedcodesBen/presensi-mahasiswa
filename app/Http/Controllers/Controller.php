<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Fungsi untuk menampilkan halaman login
    public function indexLogin()
    {
        return view('login');
    }

    // Fungsi untuk memproses login
    public function userLogin(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Log::info('User role: ' . Auth::user()->role_id); // Logging role
            if (Auth::user()->role_id == 1) {
                Log::info('Redirect to admin.index'); // Tambahkan log
                return redirect()->route('admin.index');
            } else if (Auth::user()->role_id == 2) {
                Log::info('Redirect to dosen.index');
                return redirect()->route('dosen.index');
            } else {
                Log::info('Redirect to user.index');
                return redirect()->route('user.index');
            }
        } else {
            return back()->withInput()->withErrors(['error' => 'NIK atau Password salah']);
        }
    }

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Halaman Admin
    public function adminPage()
    {
        return view('admin.index');
    }

    // Halaman Dosen
    public function dosenPage()
    {
         $user = Auth::user();

        // Return the view with user data
        return view('dosen.index', compact('user'));
    }

    // Halaman User
    public function userPage()
    {
        return view('user.index');
    }
}
