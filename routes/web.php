<?php
// In routes/web.php
use App\Http\Controllers\DosenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KehadiranMahasiswaController;
use Illuminate\Support\Facades\Route;

// Route login
Route::get('/', [Controller::class, 'indexLogin'])->name('login');
Route::post('/', [Controller::class, 'userLogin'])->name('login.post');

// Route logout
Route::post('/logout', [Controller::class, 'logout'])->name('logout');

// Route Admin
Route::middleware(['checkRoles:admin'])->group(function () {
    Route::get('/admin', [Controller::class, 'adminPage'])->name('admin.index');

    // Route Dosen Management
    Route::get('/admin/dosen', [UserController::class, 'indexDosen'])->name('admin.dosen.index');
    Route::get('/admin/dosen/create', [UserController::class, 'createDosen'])->name('admin.dosen.create');
    Route::post('/admin/dosen', [UserController::class, 'storeDosen'])->name('admin.dosen.store');
    Route::get('/admin/dosen/{dosen}/edit', [UserController::class, 'editDosen'])->name('admin.dosen.edit');
    Route::put('/admin/dosen/{dosen}', [UserController::class, 'updateDosen'])->name('admin.dosen.update');
    Route::delete('/admin/dosen/{id}', [UserController::class, 'destroyDosen'])->name('admin.dosen.destroy'); 
    
    // Route Mahasiswa Management
    Route::get('/admin/mahasiswa', [UserController::class, 'indexMahasiswa'])->name('admin.mahasiswa.index');
    Route::get('/admin/mahasiswa/create', [UserController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');
    Route::post('/admin/mahasiswa', [UserController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
    Route::get('/admin/mahasiswa/{mahasiswa}/edit', [UserController::class, 'editMahasiswa'])->name('admin.mahasiswa.edit');
    Route::put('/admin/mahasiswa/{mahasiswa}', [UserController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
    Route::delete('/admin/mahasiswa/{id}', [UserController::class, 'destroyMahasiswa'])->name('admin.mahasiswa.destroy'); 
});

// Route Dosen
Route::middleware(['checkRoles:dosen'])->group(function () {
    Route::get('/dosen', [Controller::class, 'dosenPage'])->name('dosen.index');
    Route::get('/dosen/Matakuliah',[DosenController::class, 'index'])->name('dosen.matakuliah');

    Route::get('/dosen/kehadiran/create', [KehadiranMahasiswaController::class, 'create'])->name('kehadiran.mahasiswa.create');
    Route::post('/dosen/kehadiran', [KehadiranMahasiswaController::class, 'store'])->name('kehadiran.mahasiswa.store');
    Route::get('/dosen/kehadiran/{idpresensi}', [KehadiranMahasiswaController::class, 'show'])->name('kehadiran.mahasiswa.show');
});

Route::middleware(['checkRoles:user'])->group(function () {
    Route::get('/user', [Controller::class, 'userPage'])->name('user.index');
});