@extends('adminpanel.layouts.app')

@section('navlabel', 'Kelola Periode PPDB')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Periode Pendaftaran Calon Siswa</h1>

    <div class="mt-4 bg-white rounded-lg shadow-md p-6">
        <x-primary-button tag="a" href="{{ route('admin.periodeppdb.create') }}"
            customClass="bg-green-500 hover:bg-green-600">Tambah</x-primary-button>

        <x-table>
            <x-slot name="header">
                <tr class="py-10">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Jumlah Pendaftar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </x-slot>
            @foreach ($periodeppdb as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                    <td>{{ $item->tanggal_selesai->format('d M Y')}}</td>
                    <td>{{ $item->tahun_ajaran }}</td>
                    <td>{{ $item->pendaftarans->count() }}</td>
                    <td>
                        @if ($item->tanggal_selesai < now())
                            Kadaluarsa
                        @elseif ($item->tanggal_mulai > now())
                            Belum Dibuka
                        @else
                            Masih Berlaku
                        @endif
                    </td>

                    <td>
                        <x-primary-button customClass="bg-blue-500 hover:bg-blue-600" tag="a"
                            href="{{ route('admin.periodeppdb.edit', $item->id) }}">Ubah</x-primary-button>
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-periode-deletion')"
                            x-on:click="$dispatch('set-action', '{{ route('admin.periodeppdb.destroy', $item->id) }}')">{{ __('Hapus') }}</x-danger-button>
                    </td>
                </tr>
            @endforeach
        </x-table>

        <x-modal name="confirm-periode-deletion" focusable maxWidth="xl">
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
