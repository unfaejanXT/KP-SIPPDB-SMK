@extends('adminpanel.layouts.app')
@section('navlabel', 'Kelola Calon Siswa')

@section('content')
<div>
    <h1 class="text-2xl font-bold text-gray-800"></h1>
    <p class="mt-2 text-gray-600">Selamat datang di Dashboard Admin!</p>

    <!-- Tambahkan konten dashboard lainnya di sini -->
    <div class="mt-4 bg-white rounded-lg shadow-md p-6">
        <x-table>
            <x-slot name="header">
                <tr class="py-10">
                    <th scope="col">#</th>
                    <th scope="col">Nomor Registrasi</th>
                    <th scope="col">NISN</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Asal Sekolah</th>
                    <th scope="col">Tanggal Pendaftaran</th>
                    <th scope="col">Status Verifikasi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </x-slot>
        </x-table>
    </div>
</div>
@endsection