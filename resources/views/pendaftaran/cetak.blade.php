@extends('pendaftaran.layout')

@section('form-content')
<div class="p-8">
    <div class="text-center mb-8">
         <div class="inline-flex items-center justify-center p-2 bg-green-100 rounded-full mb-4">
            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
         </div>
        <h3 class="text-2xl font-bold text-gray-900">Pendaftaran Berhasil Dikirim</h3>
        <p class="text-gray-500 mt-1">Status Pendaftaran: <span class="badge bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded font-bold">Menunggu Verifikasi</span></p>
    </div>

     <div class="space-y-6">
         {{-- Info Box --}}
         <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3 text-sm text-blue-800">
                <p class="font-medium">Data Pendaftaran Anda telah kami terima.</p>
                <p class="mt-1">Mohon tunggu proses verifikasi oleh panitia. Anda dapat memantau status secara berkala melalui halaman ini atau dashboard siswa.</p>
            </div>
        </div>

         {{-- Section: Data Pribadi --}}
         <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
             <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                 <h4 class="font-bold text-gray-800 flex items-center">
                     <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                     Data Pribadi
                 </h4>
             </div>
             <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                 <div>
                     <p class="text-gray-500 mb-1">No. Pendaftaran</p>
                     <p class="font-mono font-bold text-gray-900 bg-gray-100 inline-block px-2 rounded">{{ $pendaftaran->no_pendaftaran }}</p>
                 </div>
                  <div>
                     <p class="text-gray-500 mb-1">Tanggal Daftar</p>
                     <p class="font-semibold text-gray-900">{{ $pendaftaran->updated_at->translatedFormat('d F Y H:i') }}</p>
                 </div>
                 <div>
                     <p class="text-gray-500 mb-1">Nama Lengkap</p>
                     <p class="font-semibold text-gray-900">{{ $pendaftaran->nama_lengkap }}</p>
                 </div>
                 <div>
                     <p class="text-gray-500 mb-1">NISN</p>
                     <p class="font-semibold text-gray-900">{{ $pendaftaran->nisn }}</p>
                 </div>
                 <div>
                     <p class="text-gray-500 mb-1">Tempat, Tanggal Lahir</p>
                     <p class="font-semibold text-gray-900">{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->translatedFormat('d F Y') }}</p>
                 </div>
                  <div class="col-span-1 md:col-span-2">
                     <p class="text-gray-500 mb-1">Jurusan Pilihan</p>
                     <p class="text-lg font-bold text-gray-800">{{ $jurusan->nama ?? '-' }}</p>
                 </div>
             </div>
         </div>
         
         {{-- Section: Data Orang Tua --}}
         <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
             <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                 <h4 class="font-bold text-gray-800 flex items-center">
                     <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                     Data Orang Tua
                 </h4>
             </div>
             <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                 <div>
                     <p class="text-gray-500 mb-1">Nama Ayah</p>
                     <p class="font-semibold text-gray-900">{{ $orangtua->nama_ayah }}</p>
                 </div>
                 <div>
                     <p class="text-gray-500 mb-1">Nama Ibu</p>
                     <p class="font-semibold text-gray-900">{{ $orangtua->nama_ibu }}</p>
                 </div>
                 <div class="col-span-1 md:col-span-2">
                     <p class="text-gray-500 mb-1">No. HP Orang Tua</p>
                     <p class="font-semibold text-gray-900">{{ $orangtua->no_hp_orangtua ?? '-' }}</p>
                 </div>
             </div>
         </div>

         <div class="flex justify-center mt-8 space-x-4 print:hidden">
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Bukti Pendaftaran
            </button>
             <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Ke Dashboard Siswa
            </a>
         </div>

     </div>
</div>
@endsection
