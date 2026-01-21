<?php

use App\Exports\RekapPPDBExport;



use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\StudentDashboardController;



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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






//Pengujian Model Controller
Route::get('/dashboard', [StudentDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');









require __DIR__ . '/auth.php';
