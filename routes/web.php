<?php

use App\Exports\RekapPPDBExport;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\BerkasController;
use App\Http\Controllers\Admin\CalonSiswaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PeriodePPDBController;
use App\Http\Controllers\Admin\RekapPPDBController;


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SetupController;

// First Time Setup Routes
Route::get('/setup', [SetupController::class, 'index'])->name('setup.index');
Route::post('/setup', [SetupController::class, 'store'])->name('setup.store');

Route::get('/', function () {
    return view('index');
});

Route::get('/sandbox/atomic', function () {
    return view('sandbox.atomic.index');
});

Route::get('/daftar', function () {
    return view('auth.register');
})->name('daftarakun');

Route::get('/profil', function () {
    return view('profilsekolah');
});

Route::get('/panduan', function () {
    return view('panduanreg');
});

Route::get('/demo', function () {
    return view('demo.biodata');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






//Pengujian Model Controller
Route::get('/dashboard', function () {
    return view('breeze.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'role:admin'])->group(function () {

    //Route Home Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //Route Home Dashboard
    Route::get('/admin/profil', [DashboardController::class, 'showprofile'])->name('admin.profil');

    //Route Pengumuman
    Route::get('/admin/pengumuman', [DashboardController::class, 'index'])->name('admin.pengumuman');

    //Route Jurusan
    Route::get('/admin/jurusan', [JurusanController::class, 'index'])->name('admin.jurusan');
    Route::get('/admin/jurusan/create', [JurusanController::class, 'create'])->name('admin.jurusan.create');
    Route::post('/admin/jurusan', [JurusanController::class, 'store'])->name('admin.jurusan.store');
    Route::get('/admin/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('admin.jurusan.edit');
    Route::patch('/admin/jurusan/{id}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
    Route::delete('/admin/jurusan/{id}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');

    //Route Kelola Gelombang
    Route::get('/admin/periode', [PeriodePPDBController::class, 'index'])->name('admin.periodeppdb');
    Route::get('/admin/periode/create', [PeriodePPDBController::class, 'create'])->name('admin.periodeppdb.create');
    Route::post('/admin/periode', [PeriodePPDBController::class, 'store'])->name('admin.periodeppdb.store');
    Route::get('/admin/periode/{id}/edit', [PeriodePPDBController::class, 'edit'])->name('admin.periodeppdb.edit');
    Route::patch('/admin/periode/{id}', [PeriodePPDBController::class, 'update'])->name('admin.periodeppdb.update');
    Route::delete('/admin/periode/{id}', [PeriodePPDBController::class, 'destroy'])->name('admin.periodeppdb.destroy');

    //Route Data Siswa
    Route::get('/admin/siswa', [CalonSiswaController::class, 'index'])->name('admin.calonsiswa');
    Route::get('/admin/siswa/create', [CalonSiswaController::class, 'create'])->name('admin.calonsiswa.create');
    Route::post('/admin/siswa', [CalonSiswaController::class, 'store'])->name('admin.calonsiswa.store');
    Route::get('/admin/siswa/{id}/edit', [CalonSiswaController::class, 'edit'])->name('admin.calonsiswa.edit');
    Route::patch('/admin/siswa/{id}', [CalonSiswaController::class, 'update'])->name('admin.calonsiswa.update');
    Route::delete('/admin/siswa/{id}', [CalonSiswaController::class, 'destroy'])->name('admin.calonsiswa.destroy');

    // Route Verifikasi Berkas Calon Siswa
    Route::get('/admin/berkas', [BerkasController::class, 'index'])->name('admin.berkas');

    // Route Rekap PPDB
    Route::get('/admin/rekapan', [RekapPPDBController::class, 'index'])->name('admin.rekapppdb');

    
    Route::get('/admin/akun', [AkunController::class, 'index'])->name('admin.kelolaakun');
});





require __DIR__ . '/auth.php';
