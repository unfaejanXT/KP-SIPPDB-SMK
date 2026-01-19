@extends('pendaftaran.layout')

@section('form-content')
<div class="p-10 text-center">
    <div class="mb-6">
        <div class="mx-auto h-24 w-24 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>
    
    <h2 class="text-3xl font-bold text-gray-900 mb-4">Pendaftaran Berhasil!</h2>
    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        Terima kasih telah mendaftar di SMK Solusi Bangun Indonesia. Data Anda telah kami terima dan sedang dalam proses verifikasi oleh panitia PPDB.
    </p>

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8 text-left max-w-xl mx-auto">
        <h4 class="font-bold text-blue-800 mb-2 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Informasi Selanjutnya
        </h4>
        <ul class="list-disc list-inside text-blue-700 space-y-1 text-sm">
            <li>Silakan cek status pendaftaran secara berkala melalui Dashboard Siswa.</li>
            <li>Pastikan nomor HP/WhatsApp yang didaftarkan selalu aktif.</li>
            <li>Bukti pendaftaran dapat dicetak setelah verifikasi selesai.</li>
        </ul>
    </div>

    <div class="flex justify-center gap-4">
        <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Kembali ke Beranda
        </a>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Masuk ke Dashboard
        </a>
    </div>

    {{-- Stepper Completion State for context --}}
    <div class="mt-12 opacity-50 pointer-events-none">
        <ol class="flex items-center justify-center gap-2 text-sm font-medium text-gray-500">
             <li class="flex items-center gap-2">
                <span class="h-6 w-6 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">✓</span>
                <span class="hidden sm:inline">Data Pribadi</span>
            </li>
            <li class="w-8 h-0.5 bg-green-500"></li>
            <li class="flex items-center gap-2">
                <span class="h-6 w-6 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">✓</span>
                <span class="hidden sm:inline">Data Orang Tua</span>
            </li>
            <li class="w-8 h-0.5 bg-green-500"></li>
            <li class="flex items-center gap-2">
                <span class="h-6 w-6 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">✓</span>
                <span class="hidden sm:inline">Upload Berkas</span>
            </li>
             <li class="w-8 h-0.5 bg-green-500"></li>
             <li class="flex items-center gap-2 text-green-600 font-bold">
                <span class="h-6 w-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs">4</span>
                <span>Selesai</span>
            </li>
        </ol>
    </div>
</div>
@endsection
