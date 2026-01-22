@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - Admin PPDB')
@section('header_title', 'Verifikasi Berkas')
@section('header_subtitle', 'Verifikasi kelengkapan berkas pendaftaran siswa')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6 flex items-center gap-5 shadow-sm transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                <i class="fa-solid fa-file-invoice text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-slate-800">{{ $stats['pending'] }}</div>
                <div class="text-sm text-slate-600 font-medium">Menunggu Verifikasi</div>
            </div>
        </div>
        
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 flex items-center gap-5 shadow-sm transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                <i class="fa-solid fa-file-circle-check text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-slate-800">{{ $stats['verified'] }}</div>
                <div class="text-sm text-slate-600 font-medium">Terverifikasi</div>
            </div>
        </div>

        <div class="bg-rose-50 border border-rose-100 rounded-2xl p-6 flex items-center gap-5 shadow-sm transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center shrink-0">
                <i class="fa-solid fa-file-circle-xmark text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-slate-800">{{ $stats['rejected'] }}</div>
                <div class="text-sm text-slate-600 font-medium">Ditolak / Revisi</div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('admin.verifikasi.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau NISN..." 
                    class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none border">
            </div>
            <div class="w-px bg-gray-100 hidden md:block"></div>
            <div class="relative min-w-[200px]">
                <select name="status" onchange="this.form.submit()" 
                    class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none border appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
            </div>
        </form>
    </div>

    <!-- Content Split Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- List of Pendaftar -->
        <div class="lg:col-span-7 space-y-4">
            @forelse($pendaftarans as $pendaftaran)
            <div onclick="window.location='{{ route('admin.verifikasi.show', $pendaftaran) }}'" 
                class="bg-white rounded-2xl border {{ isset($pendaftaran_id) && $pendaftaran_id == $pendaftaran->id ? 'border-blue-500 ring-4 ring-blue-50/50' : 'border-gray-100 hover:border-blue-200' }} shadow-sm p-5 relative overflow-hidden group cursor-pointer transition-all">
                
                @php
                    $pendingCount = $pendaftaran->berkas->where('status_verifikasi', 'pending')->count();
                @endphp
                
                @if($pendingCount > 0)
                <div class="absolute top-4 right-4 bg-slate-900 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm">
                    {{ $pendingCount }} berkas pending
                </div>
                @endif

                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl shrink-0">
                        {{ substr($pendaftaran->nama_lengkap, 0, 2) }}
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors">{{ $pendaftaran->nama_lengkap }}</h3>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
                            <span class="text-sm text-slate-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-id-card text-xs"></i> NISN: {{ $pendaftaran->nisn }}
                            </span>
                            <span class="text-sm text-slate-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-graduation-cap text-xs"></i> {{ $pendaftaran->jurusan->nama_jurusan ?? 'Belum ada jurusan' }}
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach($pendaftaran->berkas as $berkas)
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                        'verified' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        'rejected' => 'bg-rose-100 text-rose-700 border-rose-200',
                                    ];
                                    $statusIcon = [
                                        'pending' => 'fa-clock',
                                        'verified' => 'fa-check-circle',
                                        'rejected' => 'fa-times-circle',
                                    ];
                                    $status = $berkas->status_verifikasi ?? 'pending';
                                @endphp
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-semibold {{ $statusClasses[$status] }} flex items-center gap-1.5 border">
                                    <i class="fa-solid {{ $statusIcon[$status] }} text-[10px]"></i> {{ $berkas->jenisBerkas->nama_berkas }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-folder-open text-3xl text-slate-300"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-800">Tidak ada pendaftar</h4>
                <p class="text-slate-500 text-sm mt-1">Gunakan kata kunci atau filter lain</p>
            </div>
            @endforelse

            <div class="mt-6">
                {{ $pendaftarans->links() }}
            </div>
        </div>

        <!-- Empty State for Detail -->
        <div class="lg:col-span-5 hidden lg:block">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 sticky top-24 text-center border-dashed border-2">
                <div class="w-20 h-20 bg-blue-50 text-blue-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-mouse-pointer text-3xl"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-800">Pilih Pendaftar</h4>
                <p class="text-slate-500 text-sm mt-1">Klik salah satu pendaftar di sebelah kiri untuk melihat detail berkas</p>
            </div>
        </div>
    </div>
</div>
@endsection
