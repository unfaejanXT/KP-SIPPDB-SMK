@extends('layouts.public')

@section('title', 'Pengumuman')
@section('hideContact', true)

@section('content')
    {{-- Hero Section --}}
    {{-- HEADER SECTION --}}
    <header class="relative bg-gradient-to-r from-red-600 to-red-800 pt-16 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur-sm border border-white/30 mb-4">
                Pengumuman
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Pengumuman PPDB</h1>
            <p class="text-white/90 text-lg">Informasi dan pengumuman terbaru seputar PPDB</p>
        </div>

        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light">
        </div>
    </header>

    {{-- Search Section --}}
    <main class="max-w-7xl mx-auto px-4 -mt-20 relative z-20 pb-20">
        <div class="max-w-3xl mx-auto mb-10">
        <!--
            <form action="{{ route('pengumuman.index') }}" method="GET" class="relative shadow-lg rounded-xl bg-white">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="q" value="{{ request('q') }}"
                class="block w-full pl-11 pr-4 py-4 rounded-xl border-none ring-1 ring-slate-100 focus:ring-2 focus:ring-red-500 text-sm shadow-sm placeholder-gray-400"
                placeholder="Cari pengumuman...">
        </form>
        -->
        </div>

    {{-- Content Section --}}
    <div class="max-w-4xl mx-auto space-y-6">

        @forelse($pengumumans as $pengumuman)
            <div
                class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition duration-300">
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <span
                        class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $pengumuman->kategori ?? 'Informasi' }}</span>

                    <div class="flex items-center text-slate-400 text-xs ml-auto">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $pengumuman->created_at->format('d F Y') }}
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $pengumuman->judul }}</h3>
                <div class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-3">
                    {!! Str::limit(strip_tags($pengumuman->konten), 150) !!}
                </div>
                <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="inline-flex items-center text-sm font-semibold text-sky-600 hover:text-sky-700">
                    Baca selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pengumuman</h3>
                <p class="text-slate-500 mb-6">Saat ini belum ada pengumuman yang tersedia. Silakan cek kembali nanti.</p>
                <a href="{{ url('/') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                    Kembali ke Beranda
                </a>
            </div>

        @endforelse

        <div class="text-center pt-6">
            @if($pengumumans instanceof \Illuminate\Pagination\LengthAwarePaginator && $pengumumans->hasPages())
                 {{ $pengumumans->links() }}
            @endif
        </div>

    </div>
    </main>

    <div class="bg-slate-50 py-16 border-t border-slate-200">
        <div class="max-w-2xl mx-auto px-4 text-center">
            <div
                class="w-16 h-16 bg-sky-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-sky-200">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 mb-3">Jangan Lewatkan Informasi Penting</h2>
            <p class="text-slate-500 mb-8">Daftar sekarang untuk mendapatkan notifikasi pengumuman terbaru langsung ke
                email Anda</p>
            <a href="#"
                class="inline-flex items-center justify-center px-6 py-3 bg-sky-700 hover:bg-sky-800 text-white font-medium rounded-lg transition shadow-sm">
                Daftar Sekarang <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>

    {{-- Footer (Synced with Index) --}}
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
