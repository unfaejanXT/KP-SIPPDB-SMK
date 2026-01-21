@extends('layouts.public')

@section('title', 'Informasi Sekolah')
@section('hideContact', true)

@section('content')
    {{-- Import FontAwesome (Temporary solution to match reference visually with proper icons) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition">
                        <i class="fa-regular fa-eye text-9xl text-red-600"></i>
                    </div>
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center text-white mb-6">
                        <i class="fa-regular fa-eye text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Menjadi Sekolah Menengah Kejuruan unggulan yang menghasilkan lulusan berkarakter, berkompeten,
                        dan berdaya saing tinggi di tingkat nasional maupun internasional.
                    </p>
                </div>

                <div class="border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md transition bg-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition">
                        <i class="fa-solid fa-bullseye text-9xl text-gray-800"></i>
                    </div>
                    <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center text-white mb-6">
                        <i class="fa-solid fa-bullseye text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex gap-3">
                            <i class="fa-solid fa-circle text-[6px] text-gray-800 mt-2"></i>
                            <span>Menyelenggarakan pendidikan vokasi berkualitas dengan kurikulum berbasis
                                industri.</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-circle text-[6px] text-gray-800 mt-2"></i>
                            <span>Mengembangkan karakter siswa yang berakhlak mulia dan berjiwa wirausaha.</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-circle text-[6px] text-gray-800 mt-2"></i>
                            <span>Membangun kemitraan dengan dunia usaha dan industri.</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-circle text-[6px] text-gray-800 mt-2"></i>
                            <span>Meningkatkan kompetensi tenaga pendidik secara berkelanjutan.</span>
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
                    Laboratorium Komputer Modern</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Bengkel Praktik Otomotif</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Perpustakaan Digital</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Ruang Multimedia</div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Lapangan Olahraga</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Masjid & Musholla</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Kantin Sehat</div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Ruang UKS</div>
                <div class="col-span-2 md:col-span-4 max-w-xs mx-auto w-full bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-xs font-medium text-gray-700 hover:border-red-600 hover:text-red-600 transition cursor-default">
                    Aula Serbaguna</div>
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
                    <p class="text-xs text-gray-500">Jl. Pendidikan No. 123, Kota Harapan, Indonesia</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Telepon</h4>
                    <p class="text-xs text-gray-500">(021) 1234-5678</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Email</h4>
                    <p class="text-xs text-gray-500">ppdb@smksbi.sch.id</p>
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
    <footer class="bg-white text-gray-900 border-t border-gray-100">
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
