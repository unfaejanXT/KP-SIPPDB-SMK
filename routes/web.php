<?php

use App\Http\Controllers\Admin\AdminPengumumanController;

use App\Exports\RekapPPDBExport;



use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;


use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController;





// Installation Routes
use App\Http\Controllers\InstallController;
Route::get('/install', [InstallController::class, 'index'])->name('install.index');
Route::post('/install', [InstallController::class, 'store'])->name('install.store');

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

// Route Pendaftaran Siswa using Controller
use App\Http\Controllers\PendaftaranController;

Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/step1', [PendaftaranController::class, 'step1'])->name('pendaftaran.step1');
    Route::post('/pendaftaran/step1', [PendaftaranController::class, 'storeStep1'])->name('pendaftaran.storeStep1');
    Route::get('/pendaftaran/step2', [PendaftaranController::class, 'step2'])->name('pendaftaran.step2');
    Route::post('/pendaftaran/step2', [PendaftaranController::class, 'storeStep2'])->name('pendaftaran.storeStep2');
    Route::get('/pendaftaran/step3', [PendaftaranController::class, 'step3'])->name('pendaftaran.step3');
    Route::post('/pendaftaran/step3', [PendaftaranController::class, 'storeStep3'])->name('pendaftaran.storeStep3');
    Route::post('/pendaftaran/upload', [PendaftaranController::class, 'uploadBerkas'])->name('pendaftaran.upload');
    Route::get('/pendaftaran/step4', [PendaftaranController::class, 'step4'])->name('pendaftaran.step4');
    Route::post('/pendaftaran/submit', [PendaftaranController::class, 'submit'])->name('pendaftaran.submit');
    Route::get('/pendaftaran/sukses', [PendaftaranController::class, 'success'])->name('pendaftaran.success');
    
    // Student Dashboard Edit Routes
    Route::get('/dashboard/edit', [StudentDashboardController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/dashboard/update', [StudentDashboardController::class, 'update'])->name('pendaftaran.update');

    // New Dashboard Pages
    Route::get('/dashboard/pengumuman', [StudentDashboardController::class, 'pengumuman'])->name('dashboard.pengumuman');
    Route::get('/dashboard/kelola-berkas', [StudentDashboardController::class, 'kelolaBerkas'])->name('dashboard.berkas');
    Route::get('/dashboard/cetak-bukti', [StudentDashboardController::class, 'cetakBukti'])->name('dashboard.cetak');
});

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminJurusanController;
use App\Http\Controllers\AdminGelombangController;
use App\Http\Controllers\AdminPeriodeController;
use App\Http\Controllers\AdminCalonSiswaController;
use App\Http\Controllers\AdminVerifikasiController;

// Admin Dashboard Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', AdminUserController::class, ['as' => 'admin']);
    Route::resource('jurusan', AdminJurusanController::class, ['as' => 'admin']);
    Route::resource('periode', AdminPeriodeController::class, ['as' => 'admin']);
    Route::patch('/periode/{periode}/toggle-status', [AdminPeriodeController::class, 'toggleStatus'])->name('admin.periode.toggle-status');
    Route::resource('gelombang', AdminGelombangController::class, ['as' => 'admin']);
    Route::resource('calon-siswa', AdminCalonSiswaController::class, ['as' => 'admin']);
    
    // Verifikasi Berkas
    Route::get('/verifikasi-berkas', [AdminVerifikasiController::class, 'index'])->name('admin.verifikasi.index');
    Route::get('/verifikasi-berkas/{pendaftaran}', [AdminVerifikasiController::class, 'show'])->name('admin.verifikasi.show');
    Route::post('/verifikasi-berkas/{berkas}/status', [AdminVerifikasiController::class, 'updateStatus'])->name('admin.verifikasi.updateStatus');
    Route::post('/verifikasi-berkas/{pendaftaran}/verifikasi-semua', [AdminVerifikasiController::class, 'verifyAll'])->name('admin.verifikasi.verifyAll');

    // Pengumuman
    Route::resource('pengumuman', AdminPengumumanController::class, ['as' => 'admin']);
    Route::patch('/pengumuman/{pengumuman}/toggle-status', [AdminPengumumanController::class, 'toggleStatus'])->name('admin.pengumuman.toggle-status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






//Pengujian Model Controller
Route::get('/dashboard', [StudentDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');









require __DIR__ . '/auth.php';
