<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegStudentController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:user'])->group(function () {

  
});

Route::get('/', function () {
    return view('home');
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

    Route::get('/pendaftaran', [RegistrationController::class, 'pendaftaran'])->name('register.student');
    Route::post('/pendaftaran/store', [RegistrationController::class, 'store'])->name('register.store');
    

});

require __DIR__.'/auth.php';
