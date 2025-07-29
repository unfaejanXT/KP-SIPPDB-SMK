<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Data Calon Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <x-primary-button tag="a" href="{{ route('test.siswa.create') }}" customClass="bg-green-500 hover:bg-green-600">Tambah Data Calon Siswa</x-primary-button>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Nomor Registrasi</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Status</th>
                            </tr>
                        </x-slot>

                    </x-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>