@extends('admin.layouts.app')

@section('navlabel', 'Kelola Jurusan')

@section('content')
<div>
    <div class="mt-4 bg-white rounded-lg shadow-md p-6">
    <x-primary-button customClass="bg-green-500 hover:bg-green-600" tag="a" href="{{ route('admin.jurusan.create') }}" >Tambah Jurusan Baru</x-primary-button>
            
            <x-table>
                <x-slot name="header">
                    <tr class="py-10">
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Kuota</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </x-slot>
                @foreach ($jurusan as $jurusanItem)
                    <tr>
                        <td>{{ $jurusanItem->id }}</td>
                        <td>{{ $jurusanItem->kode }}</td>
                        <td>{{ $jurusanItem->nama }}</td>
                        <td>{{ $jurusanItem->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                        <td>{{ $jurusanItem->kuota }}</td>
                        <td>{{ $jurusanItem->status }}</td>
                        <td>
                            <x-primary-button tag="a" customClass="bg-blue-500 hover:bg-blue-600"
                                href="{{ route( 'admin.jurusan.edit', $jurusanItem->id) }}">Ubah</x-primary-button>
                            <x-danger-button 
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-jurusan-deletion')"
                                x-on:click="$dispatch('set-action', '{{ route('admin.jurusan.destroy', $jurusanItem->id) }}')">{{ __('Hapus') }}</x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <x-modal name="confirm-jurusan-deletion" focusable maxWidth="xl">
                    <form method="post" x-bind:action="action" class="p-6">
                        @method('delete')
                        @csrf
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Apakah anda yakin akan menghapus data?') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                        </p>
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Batalkan') }}
                            </x-secondary-button>
                            <x-danger-button class="ml-3">
                                {{ __('Hapus') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>

    </div>
</div>



@endsection