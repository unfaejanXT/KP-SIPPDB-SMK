<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Verifikasi Berkas Calon Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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
        </div>
    </div>
</x-app-layout>