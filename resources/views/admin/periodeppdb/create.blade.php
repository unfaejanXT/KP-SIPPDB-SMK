@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <!-- Tambahkan konten dashboard lainnya di sini -->
    <div class="mt-4 bg-white rounded-lg shadow-md p-6">
        <form method="post" action="{{ route('admin.periodeppdb.store') }}" enctype="multipart/form-data"
            class="mt-6 space-y-6">
            @csrf

            <div class="max-w-xl">
                <x-input-label for="nama" value="Nama Periode" />
                <x-text-input id="nama" type="text" name="nama" class="mt-1 block w-full"
                    value="{{ old('nama') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('nama')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="tanggal_mulai" value="Tanggal Mulai" />
                <x-text-input id="tanggal_mulai" type="date" name="tanggal_mulai" class="mt-1 block w-full"
                    value="{{ old('tanggal_mulai') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="tanggal_selesai" value="Tanggal Selesai" />
                <x-text-input id="tanggal_selesai" type="date" name="tanggal_selesai" class="mt-1 block w-full"
                    value="{{ old('tanggal_selesai') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="tahun_ajaran" value="Tahun Ajaran" />
                <x-text-input id="tahun_ajaran" type="text" name="tahun_ajaran" class="mt-1 block w-full"
                    value="{{ old('tahun_ajaran') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('tahun_ajaran')" />
            </div>
            <x-secondary-button tag="a" href="{{ route('admin.periodeppdb') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </form>
    </div>
</div>
@endsection