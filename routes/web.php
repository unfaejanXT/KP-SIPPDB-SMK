<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function () {
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('register.student');
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('register.store');
});

require __DIR__.'/auth.php';
