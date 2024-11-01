<?php

// In routes/web.php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route login
Route::get('/', [Controller::class, 'indexLogin'])->name('login');
Route::post('/', [Controller::class, 'userLogin'])->name('login.post');

// Route logout
Route::post('/logout', [Controller::class, 'logout'])->name('logout');

// Route Admin
Route::middleware(['checkRoles:admin'])->group(function () {
    Route::get('/admin', [Controller::class, 'adminPage'])->name('admin.index');
    Route::get('/admin/dosen', [UserController::class, 'indexDosen'])->name('admin.dosen.index');
    Route::get('/admin/dosen/create', [UserController::class, 'createDosen'])->name('admin.dosen.create');
    Route::post('/admin/dosen', [UserController::class, 'storeDosen'])->name('admin.dosen.store');
    Route::get('/admin/dosen/{dosen}/edit', [UserController::class, 'editDosen'])->name('dosen.edit');
    Route::put('/admin/dosen/{dosen}', [UserController::class, 'updateDosen'])->name('dosen.update');
    Route::delete('/admin/dosen/{id}', [UserController::class, 'destroyDosen'])->name('admin.dosen.destroy'); 
});

// Route Dosen
Route::middleware(['checkRoles:dosen'])->group(function () {
    Route::get('/dosen', [Controller::class, 'dosenPage'])->name('dosen.index');
});

Route::middleware(['checkRoles:user'])->group(function () {
    Route::get('/user', [Controller::class, 'userPage'])->name('user.index');
});
