<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Kelola Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

            <x-primary-button customClass="bg-green-500 hover:bg-green-600" tag="a" href="{{ route('sandbox.jurusan.create') }}" >Tambah Jurusan Baru</x-primary-button>
            
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
                                    href="{{ route( 'sandbox.jurusan.edit', $jurusanItem->id) }}">Ubah</x-primary-button>
                                <x-danger-button 
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-jurusan-deletion')"
                                    x-on:click="$dispatch('set-action', '{{ route('sandbox.jurusan.destroy', $jurusanItem->id) }}')">{{ __('Hapus') }}</x-danger-button>
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
    </div>
</div>
</x-app-layout>