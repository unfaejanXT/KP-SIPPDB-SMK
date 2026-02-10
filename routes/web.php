<?php

use App\Http\Controllers\Admin\AdminPengumumanController;

use App\Exports\RekapPPDBExport;



use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;


use App\Http\Controllers\CalonSiswa\CalonSiswaDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;





// Installation Routes
use App\Http\Controllers\InstallController;
Route::get('/install', [InstallController::class, 'index'])->name('install.index');
Route::post('/install', [InstallController::class, 'store'])->name('install.store');

use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

Route::get('/', function () {
    $jurusan = Jurusan::aktif()->get();
    $activeGelombang = Gelombang::where('is_active', '=', true)->first();
    $gelombangs = Gelombang::orderBy('tanggal_mulai', 'asc')->get();
    return view('public.index', compact('jurusan', 'activeGelombang', 'gelombangs'));
});

Route::get('/sandbox/atomic', function () {
    return view('sandbox.atomic.index');
});

Route::get('/daftar', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('daftarakun');

Route::get('/profil', function () {
    return view('public.profilsekolah');
});

Route::get('/panduan', function () {
    return view('public.panduanreg');
});

Route::get('/jadwal', function () {
    $gelombangs = Gelombang::orderBy('tanggal_mulai', 'asc')->get();
    return view('public.jadwal', compact('gelombangs'));
});

Route::get('/pengumuman', function (Request $request) {
    $query = Pengumuman::forUser(\Illuminate\Support\Facades\Auth::user());

    if ($request->has('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('konten', 'like', "%{$search}%");
        });
    }

    $pengumumans = $query->latest()->paginate(5);
    return view('public.pengumuman', compact('pengumumans'));
})->name('pengumuman.index');

Route::get('/pengumuman/{slug}', function ($slug) {
    $pengumuman = Pengumuman::forUser(\Illuminate\Support\Facades\Auth::user())
        ->where('slug', $slug)
        ->firstOrFail();
        
    return view('public.pengumuman-detail', compact('pengumuman'));
})->name('pengumuman.show');

Route::get('/demo', function () {
    return view('demo.biodata');
});

// Route Pendaftaran Siswa using Controller
use App\Http\Controllers\CalonSiswa\PendaftaranController;

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
    Route::get('/dashboard/edit', [CalonSiswaDashboardController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/dashboard/update', [CalonSiswaDashboardController::class, 'update'])->name('pendaftaran.update');
    
    // Parent Data Edit Routes
    Route::get('/dashboard/edit/orangtua', [CalonSiswaDashboardController::class, 'editOrangTua'])->name('pendaftaran.edit.orangtua');
    Route::put('/dashboard/update/orangtua', [CalonSiswaDashboardController::class, 'updateOrangTua'])->name('pendaftaran.update.orangtua');

    // New Dashboard Pages
    Route::get('/dashboard/pengumuman', [CalonSiswaDashboardController::class, 'pengumuman'])->name('dashboard.pengumuman');
    Route::get('/dashboard/pengumuman/{slug}', [CalonSiswaDashboardController::class, 'showPengumuman'])->name('dashboard.pengumuman.show');
    Route::get('/dashboard/kelola-berkas', [CalonSiswaDashboardController::class, 'kelolaBerkas'])->name('dashboard.berkas');
    Route::get('/dashboard/cetak-bukti', [CalonSiswaDashboardController::class, 'cetakBukti'])->name('dashboard.cetak');
});

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJurusanController;
use App\Http\Controllers\Admin\AdminGelombangController;
use App\Http\Controllers\Admin\AdminPeriodeController;
use App\Http\Controllers\Admin\AdminCalonSiswaController;
use App\Http\Controllers\Admin\AdminVerifikasiController;
use App\Http\Controllers\Admin\AdminLaporanController;

// Admin Dashboard Routes
Route::middleware(['auth', 'role_feature'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', AdminUserController::class, ['as' => 'admin'])->except(['create', 'edit', 'show']);
    Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::resource('jurusan', AdminJurusanController::class, ['as' => 'admin'])->except(['create', 'edit', 'show']);
    Route::resource('periode', AdminPeriodeController::class, ['as' => 'admin'])->except(['create', 'edit', 'show']);
    Route::patch('/periode/{periode}/toggle-status', [AdminPeriodeController::class, 'toggleStatus'])->name('admin.periode.toggle-status');
    Route::resource('gelombang', AdminGelombangController::class, ['as' => 'admin'])->except(['create', 'edit', 'show']);
    Route::resource('calon-siswa', AdminCalonSiswaController::class, ['as' => 'admin']);
    
    // Verifikasi Berkas
    Route::get('/verifikasi-berkas', [AdminVerifikasiController::class, 'index'])->name('admin.verifikasi.index');
    Route::get('/verifikasi-berkas/{pendaftaran}', [AdminVerifikasiController::class, 'show'])->name('admin.verifikasi.show');
    Route::post('/verifikasi-berkas/{berkas}/status', [AdminVerifikasiController::class, 'updateStatus'])->name('admin.verifikasi.updateStatus');
    Route::get('/verifikasi-berkas/{berkas}/download', [AdminVerifikasiController::class, 'download'])->name('admin.verifikasi.download');
    Route::post('/verifikasi-berkas/{pendaftaran}/verifikasi-semua', [AdminVerifikasiController::class, 'verifyAll'])->name('admin.verifikasi.verifyAll');


    // Pengumuman
    Route::resource('pengumuman', AdminPengumumanController::class, ['as' => 'admin']);
    Route::patch('/pengumuman/{pengumuman}/toggle-status', [AdminPengumumanController::class, 'toggleStatus'])->name('admin.pengumuman.toggle-status');

    // Laporan PPDB
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/export', [AdminLaporanController::class, 'export'])->name('admin.laporan.export');

    // Admin Profile
    Route::get('/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






//Pengujian Model Controller
Route::get('/dashboard', [CalonSiswaDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');









require __DIR__ . '/auth.php';
