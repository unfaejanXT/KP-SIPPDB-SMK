@extends('adminpanel.layouts.app')

@section('content')
<div class="p-6">
    <!-- Tambahkan konten dashboard lainnya di sini -->
    <div class="mt-4 bg-white rounded-lg shadow-md p-6">
        <form method="post" action="{{ route('admin.periodeppdb.update', $periodeppdb->id) }}" class="mt-6 space-y-6">
                        @method('PATCH')
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="kode_periode" value="Kode Periode" />
                            <x-text-input id="kode_periode" type="text" name="kode_periode" class="mt-1 block w-full"
                                value="{{ old('kode_periode', $periodeppdb->kode_periode) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kode_periode')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="nama_periode" value="Nama Periode" />
                            <x-text-input id="nama_periode" type="text" name="nama_periode" class="mt-1 block w-full"
                                value="{{ old('nama_periode', $periodeppdb->nama_periode) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_periode')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="tanggal_mulai" value="Tanggal Mulai" />
                            <x-text-input id="tanggal_mulai" type="date" name="tanggal_mulai" class="mt-1 block w-full"
                                value="{{ old('tanggal_mulai', $periodeppdb->tanggal_mulai->format('Y-m-d')) }}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="tanggal_selesai" value="Tanggal Selesai" />
                            <x-text-input id="tanggal_selesai" type="date" name="tanggal_selesai"
                                class="mt-1 block w-full"
                                value="{{ old('tanggal_selesai', $periodeppdb->tanggal_selesai->format('Y-m-d')) }}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="tahun_ajaran" value="Tahun Ajaran" />
                            <x-text-input id="tahun_ajaran" type="text" name="tahun_ajaran" class="mt-1 block w-full"
                                value="{{ old('tahun_ajaran', $periodeppdb->tahun_ajaran) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tahun_ajaran')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="status" value="Status" />
                            <x-select-input id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status', $periodeppdb->status) == '1' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ old('status', $periodeppdb->status) == '0' ? 'selected' : '' }}>
                                    Nonaktif</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <x-secondary-button tag="a" href="{{ route('admin.periodeppdb') }}">Cancel</x-secondary-button>
                        <x-primary-button name="save" value="true">Save</x-primary-button>
                    </form>



    </div>
</div>
@endsection


