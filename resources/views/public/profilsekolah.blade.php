@extends('layouts.public')

@section('title', 'Informasi Sekolah')
@section('hideContact', true)

@section('content')
    {{-- HEADER SECTION --}}
    <header class="relative bg-gradient-to-r from-red-600 to-red-800 pt-16 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur-sm border border-white/30 mb-4">
                Profil Sekolah
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Informasi Sekolah</h1>
            <p class="text-white/90 text-lg">Mengenal lebih dekat SMK Solusi Bangun Indonesia</p>
        </div>

        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light">
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 -mt-20 relative z-20 pb-20">

    {{-- VISI MISI --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md transition bg-white relative overflow-hidden group">

                    <h3 class="text-xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Menghasilkan sumber daya manusia yang bertakwa, profesional sesuai program keahlian dan berkarakter.
                    </p>
                </div>

                <div class="border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md transition bg-white relative overflow-hidden group">

                    <h3 class="text-xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="list-disc list-inside space-y-3 text-sm text-gray-600">
                        <li>
                            <span>Mengembangkan pribadi peserta didik yang agamis</span>
                        </li>
                        <li>
                            <span>Memberikan pelayanan terbaik kepada peserta didik sesuai program keahlian</span>
                        </li>
                        <li>
                            <span>Mewujudkan penguasaan tata kelola serta penguatan efektivitas wirausaha</span>
                        </li>
                        <li>
                            <span>Membentuk karakter peserta didik yang disiplin, mandiri, dan kompetitif</span>
                        </li>
                        <li>
                            <span>Mempersiapkan peserta didik untuk melanjutkan pendidikan ke jenjang yang lebih tinggi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- FASILITAS --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1 rounded-md uppercase tracking-wider">Fasilitas</span>
            <h2 class="mt-3 text-3xl font-bold text-gray-900">Fasilitas Lengkap & Modern</h2>
            <p class="mt-2 text-gray-600 text-sm mb-10">Kami menyediakan berbagai fasilitas pendukung pembelajaran yang
                modern dan nyaman</p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Laboratorium Komputer</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Perpustakaan</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Lapangan Olahraga</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Musholla</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Kantin Sekolah</div>


            </div>
        </div>
    </section>

    {{-- CONTACT INFO --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1 rounded-md uppercase tracking-wider">Hubungi Kami</span>
                <h2 class="mt-3 text-3xl font-bold text-gray-900">Informasi Kontak</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Alamat</h4>
                    <p class="text-xs text-gray-500">Kp. Cisrih RT 005 RW 003, Desa Sindangraja, Kecamatan Sukaluyu</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Kontak (WA)</h4>
                    <p class="text-xs text-gray-500">0896-1602-7999</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Email</h4>
                    <p class="text-xs text-gray-500">solusibangunindonesia@gmail.com</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Jam Layanan</h4>
                    <p class="text-xs text-gray-500">Senin - Jumat: 08:00 - 15:00 WIB</p>
                </div>
            </div>
        </div>
    </section>

    </main>
    {{-- FOOTER --}}
    @include('public.footer')
@endsection
