@extends('layouts.public')

@section('title', 'Beranda')
@section('hideContact', true)

@section('content')
<!-- Hero Header -->
<!-- Hero Header -->
<section class="relative bg-cover bg-center h-screen max-h-[800px] flex items-center" style="background-image: url('{{ asset('assets/images/hero.jpeg') }}');">
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 to-black/50 backdrop-blur-[2px]"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20 lg:py-32">
        <div class="lg:w-2/3">
            @if($activeGelombang)
            <span class="inline-block py-1 px-3 rounded-full bg-red-600/20 border border-red-500 text-red-100 text-xs font-semibold tracking-wider mb-6 uppercase">
                Penerimaan Peserta Didik Baru
            </span>
            @endif
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                @auth
                    @if(Auth::user()->hasRole('user'))
                        Halo, {{ Auth::user()->name }}! <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">Selamat Datang Kembali</span>
                    @else
                        Halo, {{ Auth::user()->name }}! <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">
                            @if(Auth::user()->hasRole('admin')) Administrator
                            @elseif(Auth::user()->hasRole('kepala_sekolah')) Kepala Sekolah
                            @elseif(Auth::user()->hasRole('panitia_ppdb')) Panitia PPDB
                            @elseif(Auth::user()->hasRole('operator_sekolah')) Operator Sekolah
                            @else Staff Sekolah @endif
                        </span>
                    @endif
                @else
                    Selamat Datang di <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">SMK Solusi Bangun Indonesia</span>
                @endauth
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed max-w-2xl">
                @auth
                    @if(Auth::user()->hasRole('user'))
                        Lanjutkan proses pendaftaran Anda atau pantau informasi terbaru seputar PPDB melalui Dashboard Anda.
                    @else
                        @if(Auth::user()->hasRole('kepala_sekolah'))
                            Pantau laporan terkini, statistik pendaftaran, dan evaluasi proses PPDB secara real-time.
                        @elseif(Auth::user()->hasRole('panitia_ppdb') || Auth::user()->hasRole('operator_sekolah'))
                            Kelola data calon siswa, verifikasi berkas, dan atur jalannya proses seleksi dengan efisien.
                        @else
                            Kelola seluruh sistem PPDB, manajemen pengguna, data siswa, dan konfigurasi aplikasi dengan mudah dan aman.
                        @endif
                    @endif
                @else
                    Bergabunglah dengan kami untuk mewujudkan masa depan gemilang dengan pendidikan berkualitas dan berkarakter. Segera daftarkan diri Anda sekarang.
                @endauth
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                @auth
                    @if(Auth::user()->hasRole('user'))
                    <a href="{{ route('dashboard') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-red-700 rounded-xl hover:bg-red-800 transition duration-300 shadow-lg shadow-red-900/30 transform hover:-translate-y-1">
                        Akses Dashboard
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    @else
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-red-700 rounded-xl hover:bg-red-800 transition duration-300 shadow-lg shadow-red-900/30 transform hover:-translate-y-1">
                        Dashboard Admin
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </a>
                    @endif
                @else
                @if($activeGelombang)
                <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-red-700 rounded-xl hover:bg-red-800 transition duration-300 shadow-lg shadow-red-900/30 transform hover:-translate-y-1">
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                @else
                <a href="#jurusan" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-red-700 rounded-xl hover:bg-red-800 transition duration-300 shadow-lg shadow-red-900/30 transform hover:-translate-y-1">
                    Lihat Jurusan
                </a>
                @endif
                <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-white/10 border border-white/20 rounded-xl hover:bg-white/20 backdrop-blur-sm transition duration-300">
                    Masuk Akun
                </a>
                @endauth
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row gap-8 text-gray-400">
                <div>
                    <p class="text-xs uppercase tracking-wider mb-1 text-gray-500">Periode Pendaftaran</p>
                    <p class="text-white font-semibold">
                        {{ $activeGelombang ? $activeGelombang->nama : 'Tutup' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider mb-1 text-gray-500">Status</p>
                    @if($activeGelombang)
                    <div class="flex items-center text-green-400 font-semibold gap-2">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        Sedang Dibuka
                    </div>
                    @else
                    <div class="flex items-center text-red-400 font-semibold gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        Pendaftaran Ditutup
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION: JADWAL PENDAFTARAN --}}
{{-- SECTION: JADWAL PENDAFTARAN --}}
@if($gelombangs->isNotEmpty())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-red-600 font-semibold text-sm tracking-wider uppercase mb-2 block">Timeline
                PPDB</span>
            <h2 class="text-3xl font-bold text-gray-900">Jadwal Pendaftaran</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">Informasi waktu pelaksanaan Pendaftaran Peserta Didik Baru.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($gelombangs as $schedule)
            @php
                $isActive = $activeGelombang && $activeGelombang->id == $schedule->id && $schedule->is_active;
                $borderClass = $isActive ? 'border-red-500 ring-4 ring-red-500/10' : 'border-gray-200';
                $statusColor = $isActive ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600';
                $statusText = $isActive ? 'Sedang Dibuka' : ($schedule->is_active ? 'Dibuka' : 'Ditutup');
            @endphp
            <div class="relative bg-white rounded-2xl p-8 border {{ $borderClass }} transition hover:shadow-xl group">
                @if($isActive)
                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-red-600 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                    Sedang Dibuka
                </div>
                @endif

                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-xl font-bold text-gray-900">{{ $schedule->nama }}</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">
                            {{ $schedule->tanggal_mulai ? \Carbon\Carbon::parse($schedule->tanggal_mulai)->format('d M') : '-' }} - 
                            {{ $schedule->tanggal_selesai ? \Carbon\Carbon::parse($schedule->tanggal_selesai)->format('d M Y') : '-' }}
                        </span>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 space-y-3">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Tes Minat Bakat
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Gratis Biaya Pendaftaran
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- SECTION: JURUSAN (Pilih Masa Depanmu) --}}
<section class="py-20 bg-gray-50" id="jurusan">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-red-600 font-semibold text-sm tracking-wider uppercase mb-2 block">Program
                Keahlian</span>
            <h2 class="text-3xl font-bold text-gray-900">Pilih Masa Depanmu</h2>
            <p class="text-gray-500 mt-3">Program keahlian unggulan yang siap mencetak tenaga kerja profesional
                dan kompeten di bidangnya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $defaultIcons = [
                'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', // Code
                'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', // Server
                'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', // Gear
                'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z', // Building/Calc
                'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', // Image
                'M13 10V3L4 14h7v7l9-11h-7z', // Lightning
            ];
            $colors = [
                'bg-blue-100 text-blue-600',
                'bg-green-100 text-green-600',
                'bg-orange-100 text-orange-600',
                'bg-purple-100 text-purple-600',
                'bg-pink-100 text-pink-600',
                'bg-red-100 text-red-600',
            ];
            @endphp

            @forelse($jurusan as $j)
            @php
                $color = $colors[$loop->index % count($colors)];
                $icon = $defaultIcons[$loop->index % count($defaultIcons)];
            @endphp
            <div
                class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition group cursor-pointer">
                <div
                    class="w-12 h-12 rounded-lg {{ $color }} flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="{{ $icon }}"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-gray-900 mb-1 flex items-center gap-2">
                    {{ $j->kode }} <span
                        class="text-xs font-normal px-2 py-0.5 bg-gray-100 rounded text-gray-500">Akreditasi
                        A</span>
                </h3>
                <p class="text-gray-600 text-sm mb-4">{{ $j->nama }}</p>
                <div class="text-red-600 text-sm font-medium flex items-center">
                    Lihat Detail <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500 bg-white rounded-xl border border-gray-200 border-dashed">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900">Belum ada Program Keahlian</h3>
                <p class="mt-1">Silahkan hubungi admin untuk informasi lebih lanjut.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- SECTION: LANGKAH PENDAFTARAN --}}
@if($activeGelombang)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-red-600 font-semibold text-sm tracking-wider uppercase mb-2 block">Panduan
                Praktis</span>
            <h2 class="text-3xl font-bold text-gray-900">Langkah Mudah Mendaftar</h2>
            <p class="text-gray-500 mt-3">Ikuti 6 langkah sederhana berikut untuk menyelesaikan pendaftaran Anda
                dengan mudah dan cepat.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 relative">
            {{-- Connecting Line (Desktop Only) --}}
            <div class="hidden lg:block absolute top-12 left-0 w-full h-0.5 bg-gray-100 -z-0"></div>

            @php
            $steps = [
            ['num' => '1', 'title' => 'Register Akun', 'desc' => 'Buat akun dengan nomor WA dan email yang aktif.',
            'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z'],
            ['num' => '2', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi formulir biodata siswa dan data orang
            tua/wali.', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414
            5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['num' => '3', 'title' => 'Upload Berkas', 'desc' => 'Unggah dokumen syarat seperti Ijazah, KK, dan Akta
            Kelahiran.', 'icon' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12'],
            ['num' => '4', 'title' => 'Cetak Bukti', 'desc' => 'Unduh dan cetak kartu bukti pendaftaran Anda.', 
            'icon' => 'M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z'],
            ['num' => '5', 'title' => 'Verifikasi', 'desc' => 'Tim kami akan memverifikasi data dan berkas yang
            telah dikirim.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2
            0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
            ['num' => '6', 'title' => 'Pengumuman', 'desc' => 'Pantau hasil seleksi melalui dashboard akun siswa
            Anda.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
            @endphp

            @foreach($steps as $step)
            <div class="relative z-10 bg-white p-6 rounded-xl border border-gray-100 shadow-sm text-center">
                <div
                    class="w-10 h-10 rounded-full bg-red-600 text-white font-bold flex items-center justify-center mx-auto mb-4 relative">
                    {{ $step['num'] }}
                    @if($loop->last)
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                    </span>
                    @endif
                </div>
                <div
                    class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mx-auto mb-4 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="{{ $step['icon'] }}"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $step['title'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA & FOOTER --}}
<footer class="bg-white text-gray-900 border-t border-gray-100">
    {{-- CTA --}}
    {{-- CTA --}}
    @if($activeGelombang)
    <div class="bg-gradient-to-r from-red-600 to-red-800 py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
        </div>
        <div class="max-w-4xl mx-auto text-center px-6 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">Siap Bergabung dengan Kami?</h2>
            <p class="text-white/90 mb-8 text-lg">Jangan lewatkan kesempatan untuk menjadi bagian dari SMK Solusi Bangun Indonesia. Daftar sekarang dan raih masa depan cemerlang.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="px-8 py-3 bg-white text-red-700 font-bold rounded-lg shadow-lg hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
                <a href="#"
                    class="px-8 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white/10 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
        </div>
        <div class="max-w-4xl mx-auto text-center px-6 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">Mari Bergabung Bersama Kami!</h2>
            <p class="text-white/90 mb-8 text-lg">Nantikan pembukaan Pendaftaran Peserta Didik Baru (PPDB) periode selanjutnya. Ikuti update terbaru melalui website dan sosial media kami.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#"
                    class="px-8 py-3 bg-white text-gray-900 font-bold rounded-lg shadow-lg hover:bg-gray-100 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-4 gap-12">
            {{-- Column 1 --}}
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">SMK Solusi Bangun</h3>
                        <p class="text-sm font-semibold text-red-600 tracking-wider">INDONESIA</p>
                    </div>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-6 max-w-sm">
                    Mencetak generasi unggul, kompeten, dan siap kerja melalui pendidikan vokasi berkualitas.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-8 h-8 rounded bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition"><svg
                            class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg></a>
                    <a href="#"
                        class="w-8 h-8 rounded bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition"><svg
                            class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg></a>
                </div>
            </div>

            {{-- Column 2 --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">Tautan Cepat</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-red-600 transition">Info Pendaftaran</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">Jadwal Seleksi</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">Panduan Orang Tua</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">Beasiswa</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-red-600 transition">Masuk Akun</a></li>
                </ul>
            </div>

            {{-- Column 3 --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">Kontak</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jl. Pendidikan No. 123, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span>(021) 123-4567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span>info@solusibangun.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-gray-200 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} SMK Solusi Bangun Indonesia. Hak Cipta Dilindungi.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-red-700">Kebijakan Privasi</a>
                <a href="#" class="hover:text-red-700">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
@endsection
