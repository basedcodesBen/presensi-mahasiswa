<?php
// In routes/web.php
use App\Http\Controllers\DosenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KehadiranMahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProgramStudiController;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Route;

// Route login
Route::get('/', [Controller::class, 'indexLogin'])->name('login');
Route::post('/', [Controller::class, 'userLogin'])->name('login.post');

// Route logout
Route::post('/logout', [Controller::class, 'logout'])->name('logout');

// Route Admin
Route::middleware(['checkRoles:admin'])->group(function () {
    Route::get('/admin', [Controller::class, 'adminPage'])->name('admin.index');

    // Route Fakultas Management
    Route::get('/admin/fakultas', [FakultasController::class, 'index'])->name('admin.fakultas.index');
    Route::get('/admin/fakultas/create', [FakultasController::class, 'create'])->name('admin.fakultas.create');
    Route::post('/admin/fakultas', [FakultasController::class, 'store'])->name('admin.fakultas.store');
    Route::get('/admin/fakultas/{fakultas}/edit', [FakultasController::class, 'edit'])->name('admin.fakultas.edit');
    Route::put('/admin/fakultas/{fakultas}', [FakultasController::class, 'update'])->name('admin.fakultas.update');
    Route::delete('/admin/fakultas/{id}', [FakultasController::class, 'destroy'])->name('admin.fakultas.destroy'); 
    
    Route::get('/admin/programstudi', [ProgramStudiController::class, 'index'])->name('admin.programstudi.index');
    Route::get('/admin/programstudi/create', [ProgramStudiController::class, 'create'])->name('admin.programstudi.create');
    Route::post('/admin/programstudi', [ProgramStudiController::class, 'store'])->name('admin.programstudi.store');
    Route::get('/admin/programstudi/{fakultas}/edit', [ProgramStudiController::class, 'edit'])->name('admin.programstudi.edit');
    Route::put('/admin/programstudi/{fakultas}', [ProgramStudiController::class, 'update'])->name('admin.programstudi.update');
    Route::delete('/admin/programstudi/{id}', [ProgramStudiController::class, 'destroy'])->name('admin.programstudi.destroy'); 

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
    
    Route::get('/admin/matakuliah', [MataKuliahController::class, 'index'])->name('admin.matakuliah.index');
    Route::post('/admin/matakuliah/{fakultas}/{prodi}', [MataKuliahController::class, 'storeMatkul'])->name('admin.matakuliah.store');
    Route::post('/admin/matakuliah/{fakultas}/{prodi}/{matkul}', [MataKuliahController::class, 'storeDosen'])->name('admin.matakuliah.storeDosen');
    Route::post('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/{kelas}', [MataKuliahController::class, 'storeMahasiswa'])->name('admin.matakuliah.storeMahasiswa');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}/create', [MatakuliahController::class, 'createMatkul'])->name('admin.matakuliah.create');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/create', [MatakuliahController::class, 'createDosen'])->name('admin.matakuliah.createdosen');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/{kelas}/add', [MatakuliahController::class, 'addMahasiswa'])->name('admin.matakuliah.addmahasiswa');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/edit', [MataKuliahController::class, 'editMatkul'])->name('admin.matakuliah.edit');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/{kelas}/edit', [MataKuliahController::class, 'editClass'])->name('admin.matakuliah.editkelas');
    Route::put('/admin/matakuliah/{fakultas}/{prodi}/{matkul}', [MataKuliahController::class, 'updateMatkul'])->name('admin.matakuliah.update');
    Route::put('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/{kelas}', [MataKuliahController::class, 'updateKelas'])->name('admin.matakuliah.updatekelas');
    Route::delete('/admin/matakuliah/{fakultas}/{prodi}/{matkul}', [MataKuliahController::class, 'destroyMatkul'])->name('admin.matakuliah.destroy');
    Route::delete('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/{dosen}', [MataKuliahController::class, 'destroyDosen'])->name('admin.matakuliah.destroyDosen');
    Route::delete('/admin/matakuliah/{fakultas}/{prodi}/{matkul}/{kelas}/{mahasiswa}', [MataKuliahController::class, 'destroyMahasiswa'])->name('admin.matakuliah.destroyMahasiswa');
    Route::get('/admin/matakuliah/{fakultas}', [MataKuliahController::class, 'fakultasDetail'])->name('admin.matakuliah.fakultasdetail');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}', [MataKuliahController::class, 'prodiDetail'])->name('admin.matakuliah.prodidetail');
    Route::get('/admin/matakuliah/{fakultas}/{prodi}/{matkul}', [MataKuliahController::class, 'matkulDetail'])->name('admin.matakuliah.matkuldetail');
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