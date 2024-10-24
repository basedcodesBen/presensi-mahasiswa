<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

// Route halaman utama (login) dengan nama 'login'
Route::get('/', [Controller::class, 'indexLogin'])->name('login');
Route::post('/', [Controller::class, 'userLogin'])->name('login.post');

// Route untuk logout dengan nama 'logout'
Route::get('/logout', [Controller::class, 'logout'])->name('logout');

// Route dengan middleware untuk role protection
Route::middleware(['checkRoles'])->group(function () {
    \Log::info('masuk checkRoles');
    Route::get('/admin', [Controller::class, 'adminPage'])->name('admin.index');
    Route::get('/dosen', [Controller::class, 'dosenPage'])->name('dosen.page');
    Route::get('/user', [Controller::class, 'userPage'])->name('user.page');
});
