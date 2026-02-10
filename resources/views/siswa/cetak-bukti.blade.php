@extends('layouts.student')

@section('title', 'Cetak Bukti Pendaftaran - SMK SBI')
@section('header_title', 'Cetak Bukti Pendaftaran')
@section('header_subtitle', 'Cetak atau unduh bukti pendaftaran Anda')

@section('content')
@if(in_array($pendaftaran->status, ['terverifikasi', 'diterima', 'ditolak']))
<div class="mb-6">
    <div class="flex gap-3 mb-6">
        <button
            onclick="window.print()"
            class="inline-flex items-center gap-2 px-4 py-2 bg-[#1a4f9c] text-white text-sm font-medium rounded hover:bg-blue-800 transition-colors shadow-sm print:hidden">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak
        </button>
        <button
            onclick="window.print()"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-slate-700 border border-slate-200 text-sm font-medium rounded hover:bg-gray-50 transition-colors shadow-sm print:hidden">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Unduh PDF
        </button>
    </div>

    <div class="bg-white rounded shadow-sm border border-gray-100 max-w-4xl mx-auto p-8 md:p-12 relative">
        <div class="absolute top-4 right-4">
            <button class="relative p-2 text-gray-400 hover:text-gray-500">
            </button>
        </div>

        <div class="text-center mb-8">
            <div
                class="w-16 h-16 bg-[#ebf3ff] rounded-full flex items-center justify-center mx-auto mb-4 text-[#1a4f9c]">
                <svg class="w-9 h-9" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z" />
                    <path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z" />
                </svg>
            </div>
            <h1 class="text-lg md:text-xl font-bold text-slate-800 uppercase tracking-wide">SMK Solusi
                Bangun Indonesia</h1>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Jl. Tungturunan - Jangari, Kab. Cianjur, Jawa
                Barat</p>
            <p class="text-xs md:text-sm text-slate-500">NPSN: 69943169 | Email:
                solusibangunindonesia@gmail.com</p>
        </div>

        <hr class="border-t border-gray-200 mb-8">

        <div class="text-center mb-8">
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wide mb-1">BUKTI PENDAFTARAN
                SISWA BARU</h2>
            <p class="text-xs text-slate-500">Tahun Ajaran {{ $pendaftaran->gelombang->periode->tahun_ajaran ?? '2024/2025' }}</p>
        </div>

        <div class="bg-[#f0f6ff] border border-blue-100 rounded-lg py-6 text-center mb-10">
            <p class="text-xs text-slate-500 mb-1">Nomor Pendaftaran</p>
            <p class="text-xl md:text-2xl font-bold text-[#1a4f9c] tracking-wider">{{ $pendaftaran->no_pendaftaran }}</p>
        </div>

        <div class="space-y-8 text-sm text-slate-600">

            <div>
                <h3 class="font-bold text-slate-800 mb-4 text-sm">Data Calon Siswa</h3>
                <div class="grid grid-cols-[160px_10px_1fr] gap-y-3 md:gap-y-2">
                    <div>Nama Lengkap</div>
                    <div>:</div>
                    <div class="font-medium text-slate-800">{{ $pendaftaran->nama_lengkap }}</div>

                    <div>NISN</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->nisn }}</div>

                    <div>Tempat, Tanggal Lahir</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->translatedFormat('d F Y') }}</div>

                    <div>Jenis Kelamin</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>

                    <div>Agama</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->agama }}</div>

                    <div>Alamat</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->alamat_rumah }}</div>

                    <div>Asal Sekolah</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->asal_sekolah }}</div>

                    <div>Jurusan Pilihan</div>
                    <div>:</div>
                    <div>{{ $pendaftaran->jurusan->nama ?? '-' }}</div>
                </div>
            </div>

            <hr class="border-dashed border-gray-200">

            <div>
                <h3 class="font-bold text-slate-800 mb-4 text-sm">Data Orang Tua/Wali</h3>
                <div class="grid grid-cols-[160px_10px_1fr] gap-y-3 md:gap-y-2">
                    <div>Nama Ayah</div>
                    <div>:</div>
                    <div class="font-medium text-slate-800">{{ $orangtua->nama_ayah ?? '-' }}</div>

                    <div>Pekerjaan Ayah</div>
                    <div>:</div>
                    <div>{{ $orangtua->pekerjaan_ayah ?? '-' }}</div>

                    <div>Nama Ibu</div>
                    <div>:</div>
                    <div class="font-medium text-slate-800">{{ $orangtua->nama_ibu ?? '-' }}</div>

                    <div>Pekerjaan Ibu</div>
                    <div>:</div>
                    <div>{{ $orangtua->pekerjaan_ibu ?? '-' }}</div>

                    <div>No. HP Orang Tua</div>
                    <div>:</div>
                    <div>{{ $orangtua->no_hp_orangtua ?? '-' }}</div>
                </div>
            </div>

        </div>

        <div class="mt-12 flex justify-end">
            <div class="text-center w-48">
                <p class="text-xs text-slate-500 mb-16">Cianjur, {{ now()->translatedFormat('d F Y') }}</p>
                <p
                    class="text-sm font-medium text-slate-800 border-t border-slate-300 pt-2 inline-block w-full">
                    Panitia PPDB</p>
            </div>
        </div>

        <div
            class="mt-8 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between text-xs text-slate-500 gap-2">
            <div>
                Tanggal Cetak: {{ now()->translatedFormat('d F Y') }}
            </div>
            <div class="flex gap-1">
                Status: 
                @php
                    $statusColors = [
                        'draft' => 'text-gray-600 bg-gray-50',
                        'submitted' => 'text-blue-600 bg-blue-50',
                        'menunggu_verifikasi' => 'text-yellow-600 bg-yellow-50',
                        'terverifikasi' => 'text-green-600 bg-green-50',
                        'diterima' => 'text-green-700 bg-green-100',
                        'ditolak' => 'text-red-600 bg-red-50',
                    ];
                    $statusLabels = [
                        'draft' => 'Draft',
                        'submitted' => 'Terkirim',
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'terverifikasi' => 'Terverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ];
                    $color = $statusColors[$pendaftaran->status] ?? 'text-gray-600 bg-gray-50';
                    $label = $statusLabels[$pendaftaran->status] ?? ucfirst($pendaftaran->status);
                @endphp
                <span class="font-medium px-2 py-0.5 rounded {{ $color }}">{{ $label }}</span>
            </div>
        </div>

    </div>
    <div class="max-w-4xl mx-auto mt-6 bg-gray-100 rounded-lg p-5 text-xs text-slate-600">
        <p class="font-bold text-slate-700 mb-2">Catatan Penting:</p>
        <ul class="list-disc list-inside space-y-1 ml-1">
            <li>Bukti pendaftaran ini harap disimpan dengan baik</li>
            <li>Bukti ini merupakan syarat untuk mengikuti proses seleksi</li>
            <li>Informasi lebih lanjut dapat menghubungi panitia PPDB</li>
        </ul>
    </div>
</div>
@else
<div class="max-w-xl mx-auto mt-12 bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
    <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
        <i class="fa-regular fa-clock"></i>
    </div>
    <h2 class="text-xl font-bold text-slate-800 mb-2">Verifikasi Berkas Dalam Proses</h2>
    <p class="text-slate-600 mb-6">
        Mohon maaf, Anda belum dapat mencetak bukti pendaftaran karena berkas Anda masih dalam proses verifikasi oleh panitia.
        Silahkan cek kembali status pendaftaran Anda secara berkala.
    </p>
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1a4f9c] text-white font-medium rounded-lg hover:bg-blue-800 transition-colors">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>
</div>
@endif
@endsection
