@extends('admin.layouts.app')
@section('navlabel', 'Dashboard')

@section('content')

<div>
    <!-- Tambahkan konten dashboard lainnya di sini -->
    <div class=" bg-white rounded-lg shadow-md p-5">

        <!-- Peringatan dan Notifikasi -->
        <div>
            <div class="mb-4">
                <h2 class=" text-2xl font-semibold text-gray-800"><i class="bi bi-megaphone mr-3"></i>Pengumuman</h2>
                <hr class="my-2 border-t-2 border-gray-300">
            </div>

            <div class="card bg-yellow-100 border-l-4 border-yellow-600 p-4 mb-4">
                <div class="font-semibold text-yellow-800">
                    Peringatan!
                </div>
                <div class="text-yellow-800">
                    Tenggat waktu verifikasi berkas untuk gelombang pendaftaran saat ini adalah
                    pada 2025-05-01. Harap segera menyelesaikan verifikasi berkas.
                </div>
            </div>

            <div class="card bg-blue-100 border-l-4 border-blue-600 p-4">
                <div class="font-semibold text-blue-800">
                    Informasi!
                </div>
                <div class="text-blue-800">
                    Gelombang pendaftaran kedua akan dibuka mulai 2025-06-01. Pastikan semua
                    data sudah terupdate.
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-5">
        <div class="mb-4">
            <h2 class=" text-2xl font-semibold text-gray-800"><i class="bi bi-megaphone mr-3"></i>Statistik Pendaftaran Tahun Ajaran 2024/2025</h2>
            <hr class="my-2 border-t-2 border-gray-300">
        </div>
        <div class="py-6 flex justify-around space-evenly">
            <!-- Total Siswa Mendaftar -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                <div class="bg-blue-500 rounded-lg p-3 mr-4">
                    <i class="bi bi-person-fill text-white text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Total Siswa Mendaftar</h3>
                    <span class="text-2xl font-bold text-gray-900">{{$totalPendaftar}}</span>
                </div>
            </div>

            <!-- Total Data Terverifikasi -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                <div class="bg-green-500 rounded-lg p-3 mr-4">
                    <i class="bi bi-person-fill-check text-white text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Total Data Terverifikasi</h3>
                    <span class="text-2xl font-bold text-gray-900">{{$totalDiverifikasi}}</span>
                </div>
            </div>

            <!-- Total Data Belum Diverifikasi -->

            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                <div class="bg-yellow-500 rounded-lg p-3 mr-4">
                    <i class="bi bi-person-fill-exclamation text-white text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Total Data Belum Diverifikasi</h3>
                    <span class="text-2xl font-bold text-gray-900">{{$totalBelumDiverifikasi}}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilan Gelombang Pendaftaran -->
    <div class="mt-4 bg-white rounded-lg shadow-md p-5">
        <div class="mb-4">
            <h2 class=" text-2xl font-semibold text-gray-800"><i class="bi bi-megaphone mr-3"></i>Periode Pendaftaran</h2>
            <hr class="my-2 border-t-2 border-gray-300">
        </div>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card 1: Informasi Periode Pendaftaran -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Card Header -->
                <div class="bg-blue-500 text-white px-6 py-4 text-lg font-semibold">
                    Informasi Periode Pendaftaran Tahun Ajaran 2024/2025
                </div>

                <!-- Card Body -->
                <div class="px-6 py-4">
                    <h5 class="text-xl font-semibold mb-2">Tanggal Hari Ini: {{ $hariIni->format('d M Y') }}</h5>
                    <p class="text-gray-700">
                        <strong>Status Pendaftaran:</strong> {{ $statusPendaftaran }}<br>
                        <strong>Gelombang Pendaftaran:</strong> {{ $gelombang }}<br>
                        <strong>Batas Pendaftaran:</strong> {{ $tanggalMulai }} sampai {{ $tanggalSelesai }} <br>
                        <strong>Total Gelombang dalam satu periode: </strong> {{ $totalGelombang }}<br>
                        <strong>Sisa Gelombang dalam satu periode: </strong> {{ $sisaGelombang }}<br>

                    </p>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 flex justify-between items-center mt-4 border-t border-gray-200">
                    <!-- Button Kelola Gelombang Pendaftaran -->
                    <a href="{{ route('admin.periodeppdb') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg font-semibold transition duration-300">
                        Kelola Gelombang Pendaftaran
                    </a>
                    <!-- Petunjuk -->

                </div>
            </div>

            <!-- Card 2: Aktivitas Pendaftaran Gelombang -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Card Header -->
                <div class="bg-green-500 text-white px-6 py-4 text-lg font-semibold">
                    Aktivitas Pendaftaran Gelombang Saat Ini
                </div>

                <!-- Card Body -->
                <div class="px-6 py-4">
                    <h5 class="text-xl font-semibold mb-2">Jumlah Pendaftar: 100</h5>
                    <p class="text-gray-700">
                        <strong>Laki-Laki:</strong> 100<br>
                        <strong>Perempuan:</strong> 100<br>
                        <strong>Total Pendaftar:</strong>100
                    </p>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <small class="text-gray-500 text-sm">
                        Data ini menunjukkan jumlah pendaftar berdasarkan jenis kelamin dan total pendaftar saat
                        ini.
                    </small>
                </div>
            </div>
        </div>
    </div>
    @endsection