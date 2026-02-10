@extends('layouts.student')

@section('title', 'Dashboard PPDB SMK SBI')
@section('header_title', 'Dashboard')
@section('header_subtitle', 'Selamat datang di Portal PPDB SMK SBI')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">

    <div class="bg-white p-4 md:p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-3 md:gap-4 text-center sm:text-left">
        <div
            class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-lg md:text-xl shrink-0">
            <i class="fa-regular fa-file-lines"></i>
        </div>
        <div>
            <p class="text-[10px] md:text-xs font-medium text-slate-500 mb-0.5 md:mb-1">No. Daftar</p>
            <h3 class="font-bold text-slate-800 text-xs md:text-sm">{{ $pendaftaran->no_pendaftaran ?? '-' }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 md:p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-3 md:gap-4 text-center sm:text-left">
        <div
            class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-lg md:text-xl shrink-0">
            <i class="fa-solid fa-book-open"></i>
        </div>
        <div>
            <p class="text-[10px] md:text-xs font-medium text-slate-500 mb-0.5 md:mb-1">Jurusan</p>
            <h3 class="font-bold text-slate-800 text-xs md:text-sm line-clamp-1">{{ $pendaftaran->jurusan->nama_jurusan ?? '-' }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 md:p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-3 md:gap-4 text-center sm:text-left">
        <div
            class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center text-lg md:text-xl shrink-0">
            <i class="fa-regular fa-clock"></i>
        </div>
        <div>
            <p class="text-[10px] md:text-xs font-medium text-slate-500 mb-0.5 md:mb-1">Status</p>
            <h3 class="font-bold text-yellow-600 capitalize text-xs md:text-sm">{{ str_replace('_', ' ', $pendaftaran->status ?? 'Belum Mendaftar') }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 md:p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-3 md:gap-4 text-center sm:text-left">
        <div
            class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-gray-50 text-gray-600 flex items-center justify-center text-lg md:text-xl shrink-0">
            <i class="fa-regular fa-calendar"></i>
        </div>
        <div>
            <p class="text-[10px] md:text-xs font-medium text-slate-500 mb-0.5 md:mb-1">Tanggal</p>
            <h3 class="font-bold text-slate-800 text-xs md:text-sm">{{ $pendaftaran ? $pendaftaran->created_at->format('d M Y') : '-' }}</h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-lg text-slate-800">Status Pendaftaran</h3>
                    <p class="text-slate-500 text-sm">Pantau progres pendaftaran Anda</p>
                </div>
                @if($pendaftaran)
                <span
                    class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full border border-yellow-200 capitalize">
                    {{ str_replace('_', ' ', $pendaftaran->status) }}
                </span>
                @endif
            </div>

            <div class="mb-8">
                <div class="flex justify-between text-sm font-medium text-slate-600 mb-2">
                    <span>Progres Pendaftaran</span>
                    <span>{{ $progress }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-red-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <div class="relative space-y-0">
                <div class="absolute left-[23px] top-4 bottom-8 w-0.5 bg-gray-200 z-0"></div>

                <!-- Step 1: Akun -->
                <div class="relative flex gap-5 pb-8 z-10">
                    <div
                        class="w-12 h-12 rounded-full {{ $steps['akun'] ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} border-4 border-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-check text-lg"></i>
                    </div>
                    <div class="pt-2">
                        <h4 class="font-semibold text-slate-800">Pendaftaran Akun</h4>
                        <p class="text-xs text-slate-500 mt-1">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <!-- Step 2: Formulir -->
                <div class="relative flex gap-5 pb-8 z-10">
                    <div
                        class="w-12 h-12 rounded-full {{ $steps['formulir'] ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} border-4 border-white flex items-center justify-center shrink-0">
                        <i class="{{ $steps['formulir'] ? 'fa-solid fa-check' : 'fa-regular fa-circle' }} text-lg"></i>
                    </div>
                    <div class="pt-2">
                        <h4 class="font-semibold {{ $steps['formulir'] ? 'text-slate-800' : 'text-slate-400' }}">Mengisi Formulir</h4>
                        <p class="text-xs text-slate-500 mt-1">{{ $pendaftaran ? $pendaftaran->created_at->format('d M Y') : '-' }}</p>
                    </div>
                </div>

                <!-- Step 3: Upload Berkas -->
                <div class="relative flex gap-5 pb-8 z-10">
                    <div
                        class="w-12 h-12 rounded-full {{ $steps['berkas'] ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} border-4 border-white flex items-center justify-center shrink-0">
                        <i class="{{ $steps['berkas'] ? 'fa-solid fa-check' : 'fa-regular fa-circle' }} text-lg"></i>
                    </div>
                    <div class="pt-2">
                        <h4 class="font-semibold {{ $steps['berkas'] ? 'text-slate-800' : 'text-slate-400' }}">Upload Berkas</h4>
                        <p class="text-xs text-slate-500 mt-1">{{ $steps['berkas'] ? 'Selesai' : '-' }}</p>
                    </div>
                </div>

                <!-- Step 4: Verifikasi -->
                <div class="relative flex gap-5 pb-8 z-10">
                    <div
                        class="w-12 h-12 rounded-full {{ $steps['verifikasi'] ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} border-4 border-white flex items-center justify-center shrink-0 ring-2 ring-transparent">
                         @if($steps['verifikasi'])
                            <i class="fa-solid fa-check text-lg"></i>
                         @else
                            <i class="fa-regular fa-clock text-lg"></i>
                         @endif
                    </div>
                    <div class="pt-2">
                        <h4 class="font-semibold {{ $steps['verifikasi'] ? 'text-slate-800' : 'text-slate-800' }}">Verifikasi Berkas</h4>
                        <p class="text-xs text-slate-400 mt-1">{{ $steps['verifikasi'] ? 'Selesai' : 'Sedang Diproses' }}</p>
                    </div>
                </div>

                <!-- Step 5: Pengumuman -->
                <div class="relative flex gap-5 z-10">
                    <div
                        class="w-12 h-12 rounded-full {{ $steps['pengumuman'] ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} border-4 border-white flex items-center justify-center shrink-0">
                        @if($steps['pengumuman'])
                            <i class="fa-solid fa-print text-lg"></i>
                        @else
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        @endif
                    </div>
                    <div class="pt-2">
                        <h4 class="font-medium {{ $steps['pengumuman'] ? 'text-slate-800' : 'text-slate-400' }}">Cetak Bukti Pendaftaran</h4>
                        <p class="text-xs text-slate-400 mt-1">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-4">Aksi Cepat</h3>
            <div class="space-y-2">
                <a href="{{ route('pendaftaran.edit') }}"
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-red-50 hover:border-red-100 transition-colors group border border-gray-100">
                    <span class="text-sm font-medium text-slate-600 group-hover:text-red-700">Edit
                        Data Pendaftaran</span>
                    <i
                        class="fa-solid fa-arrow-right text-xs text-slate-400 group-hover:text-red-600"></i>
                </a>
                <a href="{{ route('dashboard.berkas') }}"
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-red-50 hover:border-red-100 transition-colors group border border-gray-100">
                    <span class="text-sm font-medium text-slate-600 group-hover:text-red-700">Kelola
                        Berkas</span>
                    <i
                        class="fa-solid fa-arrow-right text-xs text-slate-400 group-hover:text-red-600"></i>
                </a>
                <a href="{{ route('dashboard.cetak') }}"
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-red-50 hover:border-red-100 transition-colors group border border-gray-100">
                    <span class="text-sm font-medium text-slate-600 group-hover:text-red-700">Cetak
                        Bukti Pendaftaran</span>
                    <i
                        class="fa-solid fa-arrow-right text-xs text-slate-400 group-hover:text-red-600"></i>
                </a>
            </div>
        </div>

        <div class="bg-red-50 rounded-xl border border-red-100 p-5">
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-info text-red-500 mt-0.5"></i>
                <div>
                    <h4 class="font-bold text-red-900 text-sm mb-1">Informasi Penting</h4>
                    <p class="text-xs text-red-700 leading-relaxed">
                        Proses verifikasi membutuhkan waktu 1-3 hari kerja. Pastikan data dan berkas
                        yang Anda unggah sudah benar.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">SMK SBI Cianjur</h3>
                    <p class="text-xs text-slate-500">Terakreditasi</p>
                </div>
            </div>

            <div class="space-y-3 text-xs text-slate-600">
                <div class="flex gap-2">
                    <i class="fa-solid fa-location-dot text-slate-400 mt-0.5 w-4"></i>
                    <span>Jl. Tungturunan - Jangari, Cianjur</span>
                </div>
                <div class="flex gap-2">
                    <i class="fa-solid fa-envelope text-slate-400 mt-0.5 w-4"></i>
                    <span>solusibangunindonesia@gmail.com</span>
                </div>
                <div class="flex gap-2">
                    <i class="fa-solid fa-building-columns text-slate-400 mt-0.5 w-4"></i>
                    <span>NPSN: 69943169</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
