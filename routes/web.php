<?php

use App\Exports\RekapPPDBExport;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\BerkasController;
use App\Http\Controllers\Admin\CalonSiswaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PeriodePPDBController;
use App\Http\Controllers\Admin\RekapPPDBController;
use App\Http\Controllers\Experimental\Admin\ExAkunController;
use App\Http\Controllers\Experimental\Admin\ExBerkasController;
use App\Http\Controllers\Experimental\Admin\ExDashboardController;
use App\Http\Controllers\Experimental\Admin\ExJurusanController;
use App\Http\Controllers\Experimental\Admin\ExKelolaSiswaController;
use App\Http\Controllers\Experimental\Admin\ExPeriodePPDBController;
use App\Http\Controllers\Experimental\Admin\ExRekapPPDBController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin-layout', function () {
    return view('tailadminpanel.index');
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



Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('register.student');
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('register.store');
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


//UNTUK PENGUJIAN CONTROLLER
Route::middleware(['auth', 'role:admin'])->group(function () {
    //Route Home Dashboard
    Route::get('/test/dashboard', [ExDashboardController::class, 'index'])->name('test.dashboard');

    //Route Jurusan
    Route::get('/test/jurusan', [ExJurusanController::class, 'index'])->name('test.jurusan');
    Route::get('/test/jurusan/create', [ExJurusanController::class, 'create'])->name('test.jurusan.create');
    Route::post('/test/jurusan', [ExJurusanController::class, 'store'])->name('test.jurusan.store');
    Route::get('/test/jurusan/{id}/edit', [ExJurusanController::class, 'edit'])->name('test.jurusan.edit');
    Route::patch('/test/jurusan/{id}', [ExJurusanController::class, 'update'])->name('test.jurusan.update');
    Route::delete('/test/jurusan/{id}', [ExJurusanController::class, 'destroy'])->name('test.jurusan.destroy');

    //Route Kelola Gelombang
    Route::get('/test/gelombang', [ExPeriodePPDBController::class, 'index'])->name('test.gelombangppdb');
    Route::get('/test/gelombang/create', [ExPeriodePPDBController::class, 'create'])->name('test.gelombangppdb.create');
    Route::post('/test/gelombang', [ExPeriodePPDBController::class, 'store'])->name('test.gelombangppdb.store');
    Route::get('/test/gelombang/{id}/edit', [ExPeriodePPDBController::class, 'edit'])->name('test.gelombangppdb.edit');
    Route::match(['put', 'patch'], '/test/gelombang/{id}', [ExPeriodePPDBController::class, 'periodeppdbUpdate'])->name('test.gelombangppdb.update');
    Route::delete('/test/gelombang/{id}', [ExPeriodePPDBController::class, 'destroy'])->name('test.gelombangppdb.destroy');

    //Route Data Siswa
    Route::get('/test/siswa', [ExKelolaSiswaController::class, 'index'])->name('test.siswa');
    Route::get('/test/siswa/create', [ExKelolaSiswaController::class, 'create'])->name('test.siswa.create');
    Route::post('/test/siswa', [ExKelolaSiswaController::class, 'store'])->name('test.siswa.store');
    Route::get('/test/siswa/{id}/edit', [ExKelolaSiswaController::class, 'edit'])->name('test.siswa.edit');
    Route::patch('/test/siswa/{id}', [ExKelolaSiswaController::class, 'update'])->name('test.siswa.update');
    Route::delete('/test/siswa/{id}', [ExKelolaSiswaController::class, 'destroy'])->name('test.siswa.destroy');

    // Route Verifikasi Berkas Calon Siswa
    Route::get('/test/verifikasi', [ExBerkasController::class, 'index'])->name('test.verifikasi');
    Route::get('/test/verifikasi/create', [ExBerkasController::class, 'create'])->name('test.verifikasi.create');
    Route::post('/test/verifikasi', [ExBerkasController::class, 'store'])->name('test.verifikasi.store');
    Route::get('/test/verifikasi/{id}/edit', [ExBerkasController::class, 'edit'])->name('test.verifikasi.edit');
    Route::patch('/test/verifikasi/{id}', [ExBerkasController::class, 'update'])->name('test.verifikasi.update');
    Route::delete('/test/verifikasi/{id}', [ExBerkasController::class, 'destroy'])->name('test.verifikasi.destroy');

    // Route Hasil Rekap PPDB
    Route::get('/test/rekapanppdb', [ExRekapPPDBController::class, 'index'])->name('test.rekapanppdb');
    Route::get('/test/rekapanppdb/create', [ExRekapPPDBController::class, 'create'])->name('test.rekapanppdb.create');
    Route::post('/test/rekapanppdb', [ExRekapPPDBController::class, 'store'])->name('test.rekapanppdb.store');
    Route::get('/test/rekapanppdb/{id}/edit', [ExRekapPPDBController::class, 'edit'])->name('test.rekapanppdb.edit');
    Route::patch('/test/rekapanppdb/{id}', [ExRekapPPDBController::class, 'update'])->name('test.rekapanppdb.update');
    Route::delete('/test/rekapanppdb/{id}', [ExRekapPPDBController::class, 'destroy'])->name('test.rekapanppdb.destroy');

    // Route Kelola Akun Admin
    Route::get('/test/akun/admin', [ExAkunController::class, 'index'])->name('test.akunadmin');
    Route::get('/test/akun/admin/create', [ExAkunController::class, 'create'])->name('test.akunadmin.create');
    Route::post('/test/akun/admin', [ExAkunController::class, 'store'])->name('test.akunadmin.store');
    Route::get('/test/akun/admin/{id}/edit', [ExAkunController::class, 'edit'])->name('test.akunadmin.edit');
    Route::patch('/test/akun/admin/{id}', [ExAkunController::class, 'update'])->name('test.akunadmin.update');
    Route::delete('/test/akun/admin/{id}', [ExAkunController::class, 'destroy'])->name('test.akunadmin.destroy');

    // Route Kelola Akun Panitia PPDB
    Route::get('/test/admin/panitiappdb', [ExAkunController::class, 'index'])->name('test.akunpanitiappdb');
    Route::get('/test/admin/panitiappdb/create', [ExAkunController::class, 'create'])->name('test.akunpanitiappdb.create');
    Route::post('/test/admin/panitiappdb', [ExAkunController::class, 'store'])->name('test.akunpanitiappdb.store');
    Route::get('/test/admin/panitiappdb/{id}/edit', [ExAkunController::class, 'edit'])->name('test.akunpanitiappdb.edit');
    Route::patch('/test/admin/panitiappdb/{id}', [ExAkunController::class, 'update'])->name('test.akunpanitiappdb.update');
    Route::delete('/test/admin/panitiappdb/{id}', [ExAkunController::class, 'destroy'])->name('test.akunpanitiappdb.destroy');

});

require __DIR__ . '/auth.php';
