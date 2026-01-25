@extends('layouts.public')

@section('title', 'Panduan Pendaftaran')
@section('hideContact', true)

@section('content')
    {{-- Import FontAwesome if needed (sticking to SVGs for now but keeping consistent header) --}}
    
    {{-- Header Section (Consistent with Information School) --}}
    {{-- HEADER SECTION --}}
    <header class="relative bg-gradient-to-r from-red-600 to-red-800 pt-16 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur-sm border border-white/30 mb-4">
                Panduan
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Panduan Pendaftaran</h1>
            <p class="text-white/90 text-lg">Ikuti panduan lengkap berikut untuk mendaftar</p>
        </div>

        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light">
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 -mt-20 relative z-20 pb-20">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
            <div class="text-center mb-12">
                <span class="text-red-600 bg-red-50 px-3 py-1 rounded text-xs font-bold uppercase tracking-wider">Alur Pendaftaran</span>
                <h2 class="text-2xl font-bold text-gray-900 mt-3">Langkah Mudah Mendaftar</h2>
                <p class="text-gray-500 mt-2 text-sm">Ikuti 6 langkah sederhana berikut untuk menyelesaikan pendaftaran.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $steps = [
                    ['num' => '1', 'title' => 'Registrasi Akun', 'desc' => 'Buat akun dengan email aktif dan lengkapi data diri Anda.', 'icon' => 'user-add'],
                    ['num' => '2', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi formulir pendaftaran dengan data yang valid dan benar.', 'icon' => 'document-text'],
                    ['num' => '3', 'title' => 'Upload Berkas', 'desc' => 'Unggah dokumen persyaratan seperti Ijazah, Foto, dan KK.', 'icon' => 'upload'],
                    ['num' => '4', 'title' => 'Cetak Bukti', 'desc' => 'Unduh dan cetak kartu bukti pendaftaran Anda.', 'icon' => 'printer'],
                    ['num' => '5', 'title' => 'Verifikasi', 'desc' => 'Tim kami akan memverifikasi data dan berkas yang telah dikirim.', 'icon' => 'clipboard-check'],
                    ['num' => '6', 'title' => 'Pengumuman', 'desc' => 'Pantau pengumuman hasil seleksi melalui website atau email.', 'icon' => 'speakerphone'],
                ];
                @endphp

                @foreach($steps as $step)
                <div class="relative group">
                    <div class="flex flex-col h-full bg-white border border-gray-100 rounded-xl p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-red-100">
                        <div class="absolute -top-3 -left-3 w-8 h-8 flex items-center justify-center bg-red-600 text-white font-bold rounded-full text-sm shadow-md ring-4 ring-white">
                            {{ $step['num'] }}
                        </div>

                        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-red-600 group-hover:text-white transition-colors">
                            @if($step['icon'] == 'user-add')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            @elseif($step['icon'] == 'document-text')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            @elseif($step['icon'] == 'upload')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            @elseif($step['icon'] == 'printer')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            @elseif($step['icon'] == 'clipboard-check')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- PERSYARATAN --}}
        <div class="text-center mb-10">
            <span class="text-red-600 bg-red-50 px-3 py-1 rounded text-xs font-bold uppercase tracking-wider">Persyaratan</span>
            <h2 class="text-2xl font-bold text-gray-900 mt-3">Dokumen yang Diperlukan</h2>
            <p class="text-gray-500 mt-2 text-sm">Siapkan dokumen-dokumen berikut sebelum melakukan pendaftaran.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-red-100 transition">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-red-50 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Dokumen Wajib</h3>
                </div>
                <ul class="space-y-4">
                    @foreach(['Ijazah SMP/MTs atau Surat Keterangan Lulus (SKL)', 'Kartu Keluarga (KK)', 'Akta Kelahiran', 'Pas Foto 3x4 (latar merah)', 'Rapor semester 1-5 SMP/MTs'] as $doc)
                    <li class="flex items-start gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $doc }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-red-100 transition">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-red-50 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Dokumen Pendukung</h3>
                </div>
                <ul class="space-y-4">
                    @foreach(['Sertifikat prestasi akademik/non-akademik (jika ada)', 'Kartu Indonesia Pintar (KIP) atau KKS (jika ada)', 'Surat Keterangan Sehat dari dokter', 'Surat Keterangan Kelakuan Baik'] as $doc)
                    <li class="flex items-start gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $doc }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- FAQ --}}
        <div class="max-w-3xl mx-auto mb-20">
            <div class="text-center mb-8">
                <span class="text-red-600 bg-red-50 px-3 py-1 rounded text-xs font-bold uppercase tracking-wider">FAQ</span>
                <h2 class="text-2xl font-bold text-gray-900 mt-3">Pertanyaan Umum</h2>
            </div>

            <div class="space-y-4">
                @php
                $faqs = [
                    ['q' => 'Apakah bisa mendaftar secara offline?', 'a' => 'Pendaftaran dilakukan secara online melalui website ini. Namun, untuk verifikasi dokumen asli harus dilakukan secara langsung di sekolah sesuai jadwal yang ditentukan.'],
                    ['q' => 'Berapa biaya pendaftaran?', 'a' => 'Pendaftaran Peserta Didik Baru (PPDB) di SMK Solusi Bangun Indonesia sepenuhnya GRATIS dan tidak dipungut biaya apapun.'],
                    ['q' => 'Apakah ada ujian masuk?', 'a' => 'Ya, calon siswa akan mengikuti tes tertulis dan wawancara sebagai bagian dari proses seleksi.'],
                    ['q' => 'Kapan pengumuman hasil seleksi?', 'a' => 'Pengumuman hasil seleksi akan disampaikan maksimal 7 hari setelah penutupan pendaftaran masing-masing gelombang.']
                ];
                @endphp

                @foreach($faqs as $faq)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:border-red-100 transition">
                    <div class="p-6">
                        <h4 class="font-bold text-gray-900 text-sm mb-2">{{ $faq['q'] }}</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    {{-- WARNING SECTION --}}
    <div class="bg-amber-50 border-t border-b border-amber-100 py-12">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-100 text-amber-600 rounded-full mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-amber-900 mb-2">Peringatan</h3>
            <p class="text-amber-700 text-sm">Pastikan semua data yang diisi adalah data yang benar dan valid. Kesalahan data dapat mengakibatkan pembatalan pendaftaran. Jika ada kendala, silakan hubungi panitia PPDB melalui kontak yang tersedia.</p>
        </div>
    </div>

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
        </div>
    </footer>
@endsection
