@extends('layouts.student')

@section('title', 'Pengumuman - PPDB SMK SBI')
@section('header_title', 'Pengumuman')
@section('header_subtitle', 'Informasi terbaru seputar PPDB SMK SBI')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <section>
        <div class="flex items-center gap-2 mb-4 text-slate-800">
            <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
            <h3 class="font-bold text-base">Pengumuman Tersemat</h3>
        </div>

        <div
            class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 mb-4 hover:shadow-md transition-shadow relative group cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-wide border border-red-100">Penting</span>
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wide border border-blue-100">Baru</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Jadwal Verifikasi Berkas Gelombang
                        1</h4>
                    <div class="flex items-center text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        4 Jan 2024
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Verifikasi berkas pendaftaran gelombang 1 akan dilaksanakan pada tanggal 8-12
                        Januari 2024. Pastikan semua dokumen sudah lengkap dan valid. Calon siswa yang
                        berkasnya belum lengkap harap segera melengkapi.
                    </p>
                </div>
                <div class="ml-4 mt-2">
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-600 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
            <div class="absolute left-0 top-4 bottom-4 w-1 bg-red-500 rounded-r-full"></div>
        </div>

        <div
            class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md transition-shadow relative group cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-wide border border-emerald-100">Hasil</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Pengumuman Hasil Seleksi Gelombang
                        1</h4>
                    <div class="flex items-center text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        2 Jan 2024
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Pengumuman hasil seleksi PPDB Gelombang 1 akan diumumkan pada tanggal 15 Januari
                        2024 melalui website resmi dan dashboard masing-masing calon siswa. Pantau terus
                        status pendaftaran Anda.
                    </p>
                </div>
                <div class="ml-4 mt-2">
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-emerald-600 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="flex items-center gap-2 mb-4 text-slate-800 mt-8">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                </path>
            </svg>
            <h3 class="font-bold text-base">Semua Pengumuman</h3>
        </div>

        <div
            class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 mb-4 hover:shadow-md transition-shadow cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-600 text-[10px] font-bold uppercase tracking-wide border border-teal-100">Informasi</span>
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wide border border-blue-100">Baru</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Informasi Biaya Pendaftaran</h4>
                    <div class="flex items-center text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        3 Jan 2024
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Biaya pendaftaran PPDB SMK SBI Tahun Ajaran 2024/2025 adalah Rp 150.000,-
                        (seratus lima puluh ribu rupiah). Pembayaran dapat dilakukan melalui rekening
                        sekolah atau langsung ke panitia.
                    </p>
                </div>
                <div class="ml-4 mt-2">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md transition-shadow cursor-pointer">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-600 text-[10px] font-bold uppercase tracking-wide border border-teal-100">Informasi</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Persyaratan Pendaftaran PPDB
                        2024/2025</h4>
                    <div class="flex items-center text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        1 Jan 2024
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Dokumen yang wajib disiapkan: Pas Foto 3x4 (2 lembar), Fotokopi KTP Orang Tua,
                        Fotokopi Kartu Keluarga, Fotokopi Ijazah/SKL SMP/MTs, Fotokopi Akte Kelahiran.
                        Semua dokumen harus jelas dan dapat dibaca.
                    </p>
                </div>
                <div class="ml-4 mt-2">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <div class="h-8"></div>
</div>
@endsection
