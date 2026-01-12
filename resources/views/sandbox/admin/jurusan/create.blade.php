<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Tambah Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="post" action="{{ route('sandbox.jurusan.store') }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="kode" value="Kode Jurusan" />
                            <x-text-input id="kode" type="text" name="kode" class="mt-1 block w-full"
                                value="{{ old('kode') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kode')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="nama" value="Nama Jurusan" />
                            <x-text-input id="nama" type="text" name="nama" class="mt-1 block w-full"
                                value="{{ old('nama') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="deskripsi" value="Deskripsi" />
                            <x-text-input id="deskripsi" type="text" name="deskripsi" class="mt-1 block w-full"
                                value="{{ old('deskripsi') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="kuota" value="Kuota" />
                            <x-text-input id="kuota" type="number" name="kuota" class="mt-1 block w-full"
                                value="{{ old('kuota') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kuota')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="status" value="Status" />
                            <x-select-input id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <x-secondary-button tag="a" href="{{ route('sandbox.jurusan') }}">Cancel</x-secondary-button>
                        <x-primary-button name="save" value="true">Save</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>