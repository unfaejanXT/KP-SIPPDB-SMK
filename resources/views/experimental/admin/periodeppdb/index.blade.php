<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Gelombang Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-primary-button tag="a" href="{{ route('test.gelombangppdb.create') }}" customClass="bg-green-500 hover:bg-green-600">Tambah Gelombang Pendaftaran</x-primary-button>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Nama Periode</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Masih Berlaku</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($periodeppdb as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_periode }}</td>
                                <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                                <td>{{ $item->tanggal_selesai->format('d M Y')}}</td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->isBerlaku() ? 'Masih Berlaku' : 'Tidak Berlaku' }}</td>
                                
                                <td>
                                    <x-primary-button customClass="bg-blue-500 hover:bg-blue-600" tag="a" href="{{ route('test.gelombangppdb.edit', $item->id) }}">Ubah</x-primary-button>
                                    <x-danger-button 
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-periode-deletion')"
                                        x-on:click="$dispatch('set-action', '{{ route('test.gelombangppdb.destroy', $item->id) }}')">{{ __('Hapus') }}</x-danger-button>
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
        </div>
    </div>
</x-app-layout>