<?php

use App\Exports\RekapPPDBExport;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\BerkasController;
use App\Http\Controllers\Admin\CalonSiswaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PeriodePPDBController;
use App\Http\Controllers\Admin\RekapPPDBController;
use App\Http\Controllers\Sandbox\Admin\ExAkunController;
use App\Http\Controllers\Sandbox\Admin\ExBerkasController;
use App\Http\Controllers\Sandbox\Admin\ExDashboardController;
use App\Http\Controllers\Sandbox\Admin\ExJurusanController;
use App\Http\Controllers\Sandbox\Admin\ExKelolaSiswaController;
use App\Http\Controllers\Sandbox\Admin\ExPeriodePPDBController;
use App\Http\Controllers\Sandbox\Admin\ExRekapPPDBController;
use App\Http\Controllers\PendaftaranController;
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


// UNTUK PENGUJIAN CONTROLLER (SANDBOX)
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Route Home Dashboard
    Route::get('/sandbox/dashboard', [ExDashboardController::class, 'index'])
        ->name('sandbox.dashboard');

    // Route Jurusan
    Route::get('/sandbox/jurusan', [ExJurusanController::class, 'index'])
        ->name('sandbox.jurusan');
    Route::get('/sandbox/jurusan/create', [ExJurusanController::class, 'create'])
        ->name('sandbox.jurusan.create');
    Route::post('/sandbox/jurusan', [ExJurusanController::class, 'store'])
        ->name('sandbox.jurusan.store');
    Route::get('/sandbox/jurusan/{id}/edit', [ExJurusanController::class, 'edit'])
        ->name('sandbox.jurusan.edit');
    Route::patch('/sandbox/jurusan/{id}', [ExJurusanController::class, 'update'])
        ->name('sandbox.jurusan.update');
    Route::delete('/sandbox/jurusan/{id}', [ExJurusanController::class, 'destroy'])
        ->name('sandbox.jurusan.destroy');

    // Route Kelola Gelombang
    Route::get('/sandbox/gelombang', [ExPeriodePPDBController::class, 'index'])
        ->name('sandbox.gelombangppdb');
    Route::get('/sandbox/gelombang/create', [ExPeriodePPDBController::class, 'create'])
        ->name('sandbox.gelombangppdb.create');
    Route::post('/sandbox/gelombang', [ExPeriodePPDBController::class, 'store'])
        ->name('sandbox.gelombangppdb.store');
    Route::get('/sandbox/gelombang/{id}/edit', [ExPeriodePPDBController::class, 'edit'])
        ->name('sandbox.gelombangppdb.edit');
    Route::match(['put', 'patch'], '/sandbox/gelombang/{id}', [ExPeriodePPDBController::class, 'periodeppdbUpdate'])
        ->name('sandbox.gelombangppdb.update');
    Route::delete('/sandbox/gelombang/{id}', [ExPeriodePPDBController::class, 'destroy'])
        ->name('sandbox.gelombangppdb.destroy');

    // Route Data Siswa
    Route::get('/sandbox/siswa', [ExKelolaSiswaController::class, 'index'])
        ->name('sandbox.siswa');
    Route::get('/sandbox/siswa/create', [ExKelolaSiswaController::class, 'create'])
        ->name('sandbox.siswa.create');
    Route::post('/sandbox/siswa', [ExKelolaSiswaController::class, 'store'])
        ->name('sandbox.siswa.store');
    Route::get('/sandbox/siswa/{id}/edit', [ExKelolaSiswaController::class, 'edit'])
        ->name('sandbox.siswa.edit');
    Route::patch('/sandbox/siswa/{id}', [ExKelolaSiswaController::class, 'update'])
        ->name('sandbox.siswa.update');
    Route::delete('/sandbox/siswa/{id}', [ExKelolaSiswaController::class, 'destroy'])
        ->name('sandbox.siswa.destroy');

    // Route Verifikasi Berkas Calon Siswa
    Route::get('/sandbox/verifikasi', [ExBerkasController::class, 'index'])
        ->name('sandbox.verifikasi');
    Route::get('/sandbox/verifikasi/create', [ExBerkasController::class, 'create'])
        ->name('sandbox.verifikasi.create');
    Route::post('/sandbox/verifikasi', [ExBerkasController::class, 'store'])
        ->name('sandbox.verifikasi.store');
    Route::get('/sandbox/verifikasi/{id}/edit', [ExBerkasController::class, 'edit'])
        ->name('sandbox.verifikasi.edit');
    Route::patch('/sandbox/verifikasi/{id}', [ExBerkasController::class, 'update'])
        ->name('sandbox.verifikasi.update');
    Route::delete('/sandbox/verifikasi/{id}', [ExBerkasController::class, 'destroy'])
        ->name('sandbox.verifikasi.destroy');

    // Route Hasil Rekap PPDB
    Route::get('/sandbox/rekapanppdb', [ExRekapPPDBController::class, 'index'])
        ->name('sandbox.rekapanppdb');
    Route::get('/sandbox/rekapanppdb/create', [ExRekapPPDBController::class, 'create'])
        ->name('sandbox.rekapanppdb.create');
    Route::post('/sandbox/rekapanppdb', [ExRekapPPDBController::class, 'store'])
        ->name('sandbox.rekapanppdb.store');
    Route::get('/sandbox/rekapanppdb/{id}/edit', [ExRekapPPDBController::class, 'edit'])
        ->name('sandbox.rekapanppdb.edit');
    Route::patch('/sandbox/rekapanppdb/{id}', [ExRekapPPDBController::class, 'update'])
        ->name('sandbox.rekapanppdb.update');
    Route::delete('/sandbox/rekapanppdb/{id}', [ExRekapPPDBController::class, 'destroy'])
        ->name('sandbox.rekapanppdb.destroy');

    // Route Kelola Akun Admin
    Route::get('/sandbox/akun/admin', [ExAkunController::class, 'index'])
        ->name('sandbox.akunadmin');
    Route::get('/sandbox/akun/admin/create', [ExAkunController::class, 'create'])
        ->name('sandbox.akunadmin.create');
    Route::post('/sandbox/akun/admin', [ExAkunController::class, 'store'])
        ->name('sandbox.akunadmin.store');
    Route::get('/sandbox/akun/admin/{id}/edit', [ExAkunController::class, 'edit'])
        ->name('sandbox.akunadmin.edit');
    Route::patch('/sandbox/akun/admin/{id}', [ExAkunController::class, 'update'])
        ->name('sandbox.akunadmin.update');
    Route::delete('/sandbox/akun/admin/{id}', [ExAkunController::class, 'destroy'])
        ->name('sandbox.akunadmin.destroy');

    // Route Kelola Akun Panitia PPDB
    Route::get('/sandbox/admin/panitiappdb', [ExAkunController::class, 'index'])
        ->name('sandbox.akunpanitiappdb');
    Route::get('/sandbox/admin/panitiappdb/create', [ExAkunController::class, 'create'])
        ->name('sandbox.akunpanitiappdb.create');
    Route::post('/sandbox/admin/panitiappdb', [ExAkunController::class, 'store'])
        ->name('sandbox.akunpanitiappdb.store');
    Route::get('/sandbox/admin/panitiappdb/{id}/edit', [ExAkunController::class, 'edit'])
        ->name('sandbox.akunpanitiappdb.edit');
    Route::patch('/sandbox/admin/panitiappdb/{id}', [ExAkunController::class, 'update'])
        ->name('sandbox.akunpanitiappdb.update');
    Route::delete('/sandbox/admin/panitiappdb/{id}', [ExAkunController::class, 'destroy'])
        ->name('sandbox.akunpanitiappdb.destroy');
});


require __DIR__ . '/auth.php';
