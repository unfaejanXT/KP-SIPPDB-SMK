{{-- Public Footer Component --}}
<footer class="bg-white text-gray-900 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-12">
            {{-- Column 1 - School Info --}}
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg md:text-xl text-gray-900 leading-tight">SMK Solusi Bangun</h3>
                        <p class="text-xs md:text-sm font-semibold text-red-600 tracking-wider">INDONESIA</p>
                    </div>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-6 max-w-sm">
                    Mencetak generasi unggul, kompeten, dan siap kerja melalui pendidikan vokasi berkualitas.
                </p>
            </div>

            {{-- Column 2 - Quick Links --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-4 md:mb-6 text-sm md:text-base">Tautan Cepat</h4>
                <ul class="space-y-2 md:space-y-3 text-xs md:text-sm text-gray-500">
                    <li><a href="{{ url('/') }}" class="hover:text-red-600 transition inline-block py-1">Beranda</a></li>
                    <li><a href="{{ url('/profil') }}" class="hover:text-red-600 transition inline-block py-1">Informasi Sekolah</a></li>
                    <li><a href="{{ url('/jadwal') }}" class="hover:text-red-600 transition inline-block py-1">Jadwal PPDB</a></li>
                    <li><a href="{{ url('/panduan') }}" class="hover:text-red-600 transition inline-block py-1">Panduan</a></li>
                    <li><a href="{{ url('/pengumuman') }}" class="hover:text-red-600 transition inline-block py-1">Pengumuman</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-red-600 transition inline-block py-1">Masuk Akun</a></li>
                </ul>
            </div>

            {{-- Column 3 - Contact --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-4 md:mb-6 text-sm md:text-base">Kontak</h4>
                <ul class="space-y-3 md:space-y-4 text-xs md:text-sm text-gray-500">
                    <li class="flex items-start gap-2 md:gap-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jl. Pendidikan No. 123, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-2 md:gap-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span>(021) 123-4567</span>
                    </li>
                    <li class="flex items-center gap-2 md:gap-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span>info@solusibangun.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div
            class="border-t border-gray-200 mt-12 md:mt-16 pt-6 md:pt-8 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4 text-xs text-gray-500">
            <p class="text-center md:text-left">&copy; {{ date('Y') }} SMK Solusi Bangun Indonesia. Hak Cipta Dilindungi.</p>
        </div>
    </div>
    </div>
</footer>
