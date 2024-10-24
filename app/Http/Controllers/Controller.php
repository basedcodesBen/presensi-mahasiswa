<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Fungsi untuk menampilkan halaman login
    public function indexLogin()
    {
        return view('login');
    }

    public function userLogin(Request $request)
    {
//        $user = User::where('nrp', $request->input('nrp'))->where('password', $request->input('password'))->first();
        $result = Auth::attempt([
            'nik' => $request->input('nik'),
            'password' => $request->input('password')
        ]);

        if ($result) {
            Session::regenerate();
            \Log::info('User role: '.Auth::user()['role_id']); // Logging role
            if (Auth::user()['role_id'] == 1) {
                \Log::info('Redirect to admin.index'); // Tambahkan log
                return redirect()->route('admin.index');
            } else if (Auth::user()['role_id'] === 2) {
                return redirect('/dosen');
            }
            return redirect('/user');
        } else {
            return back()->withInput()->withErrors(['error' => 'Password salah']);
        }

    }


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
        \Log::info('Admin Page function called');
        return view('admin.index');
    }

    // Halaman Dosen
    public function dosenPage()
    {
        return view('dosen.dashboard');  // Menggunakan layout master
    }

    // Halaman User
    public function userPage()
    {
        return view('user.dashboard');  // Menggunakan layout master
    }
}
