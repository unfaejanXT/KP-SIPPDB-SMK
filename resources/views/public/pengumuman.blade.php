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
                </div>

            {{-- Column 2 --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">Tautan Cepat</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="{{ url('/') }}" class="hover:text-red-600 transition">Beranda</a></li>
                    <li><a href="{{ url('/profil') }}" class="hover:text-red-600 transition">Informasi Sekolah</a></li>
                    <li><a href="{{ url('/jadwal') }}" class="hover:text-red-600 transition">Jadwal PPDB</a></li>
                    <li><a href="{{ url('/panduan') }}" class="hover:text-red-600 transition">Panduan</a></li>
                    <li><a href="{{ url('/pengumuman') }}" class="hover:text-red-600 transition">Pengumuman</a></li>
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
        </div>
    </div>
</footer>
@endsection
