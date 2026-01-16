@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Header -->
<section class="relative bg-cover bg-center h-screen max-h-[800px] flex items-center" style="background-image: url('{{ asset('assets/images/hero.jpeg') }}');">
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 to-black/50 backdrop-blur-[2px]"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20 lg:py-32">
        <div class="lg:w-2/3">
            <span class="inline-block py-1 px-3 rounded-full bg-red-600/20 border border-red-500 text-red-100 text-xs font-semibold tracking-wider mb-6 uppercase">
                Penerimaan Peserta Didik Baru
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Selamat Datang di <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">SMK Solusi Bangun Indonesia</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed max-w-2xl">
                Bergabunglah dengan kami untuk mewujudkan masa depan gemilang dengan pendidikan berkualitas dan berkarakter. Segera daftarkan diri Anda sekarang.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-red-700 rounded-xl hover:bg-red-800 transition duration-300 shadow-lg shadow-red-900/30 transform hover:-translate-y-1">
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-white/10 border border-white/20 rounded-xl hover:bg-white/20 backdrop-blur-sm transition duration-300">
                    Masuk Akun
                </a>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row gap-8 text-gray-400">
                <div>
                    <p class="text-xs uppercase tracking-wider mb-1 text-gray-500">Periode Pendaftaran</p>
                    <p class="text-white font-semibold">Mei - Juli {{ date('Y') }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider mb-1 text-gray-500">Status</p>
                    <div class="flex items-center text-green-400 font-semibold gap-2">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        Sedang Dibuka
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section (Optional lightweight addition) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Proses Mudah</h3>
                <p class="text-gray-600">Pendaftaran dilakukan sepenuhnya secara online degan langkah-langkah yang sederhana.</p>
            </div>
            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Kurikulum Unggulan</h3>
                <p class="text-gray-600">Menyediakan berbagai jurusan kompetensi keahlian yang relevan dengan dunia industri.</p>
            </div>
            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Fasilitas Lengkap</h3>
                <p class="text-gray-600">Dilengkapi dengan laboratorium, fasilitas olahraga, dan sarana penunjang pembelajaran lainnya.</p>
            </div>
        </div>
    </div>
</section>
@endsection
