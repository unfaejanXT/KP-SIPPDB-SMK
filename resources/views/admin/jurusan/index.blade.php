@extends('layouts.admin')

@section('title', 'Kelola Jurusan - PPDB SMK SBI')
@section('header_title', 'Kelola Jurusan')
@section('header_subtitle', 'Atur jurusan dan kuota penerimaan')

@section('content')
<div x-data="{ 
    showModal: false, 
    isEdit: false, 
    formUrl: '', 
    formData: {
        id: null,
        kode: '',
        nama: '',
        deskripsi: '',
        kuota: 0,
        status: 'aktif'
    },
    openAddModal() {
        this.isEdit = false;
        this.formUrl = '{{ route('admin.jurusan.store') }}';
        this.formData = {
            id: null,
            kode: '',
            nama: '',
            deskripsi: '',
            kuota: 0,
            status: 'aktif'
        };
        this.showModal = true;
    },
    openEditModal(jurusan) {
        this.isEdit = true;
        this.formUrl = '{{ route('admin.jurusan.update', ':id') }}'.replace(':id', jurusan.id);
        this.formData = {
            id: jurusan.id,
            kode: jurusan.kode,
            nama: jurusan.nama,
            deskripsi: jurusan.deskripsi,
            kuota: jurusan.kuota,
            status: jurusan.status
        };
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
        this.showDeleteModal = false;
    },
    showDeleteModal: false,
    deleteAction: '',
    deleteName: '',
    confirmDelete(url, name) {
        this.deleteAction = url;
        this.deleteName = name;
        this.showDeleteModal = true;
    }
}">

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="p-3 bg-slate-50 rounded-lg text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_jurusan'] }}</h3>
                <p class="text-sm text-slate-500">Total Jurusan</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-lg text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_kuota'] }}</h3>
                <p class="text-sm text-slate-500">Total Kuota</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="p-3 bg-teal-50 rounded-lg text-teal-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_pendaftar'] }}</h3>
                <p class="text-sm text-slate-500">Total Pendaftar</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['kepenuhan'] }}%</h3>
                <p class="text-sm text-slate-500">Tingkat Kepenuhan</p>
            </div>
        </div>
    </div>

    <!-- Alert Success/Error -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-end mb-6">
        <button @click="openAddModal()"
            class="bg-[#1e293b] hover:bg-[#0f172a] text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                </path>
            </svg>
            Tambah Jurusan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-10">
        @forelse($jurusans as $jurusan)
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 relative">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-lg bg-[#eff6ff] text-[#2563eb] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-slate-800 text-lg">{{ $jurusan->nama }}</h3>
                            @if($jurusan->status == 'aktif')
                                <span class="px-2 py-0.5 rounded-full bg-green-50 text-green-600 text-[10px] font-bold tracking-wide">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 text-[10px] font-bold tracking-wide">Nonaktif</span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Kode: {{ $jurusan->kode }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        style="display: none;"
                        class="absolute right-0 top-6 w-32 bg-white border border-gray-100 rounded-lg shadow-lg py-1 z-10 transition-all">
                        <button @click="openEditModal({{ $jurusan }}); open = false"
                            class="flex w-full items-center gap-2 px-4 py-2 text-xs text-gray-600 hover:bg-gray-50 text-left">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                            Edit
                        </button>
                        <button @click="confirmDelete('{{ route('admin.jurusan.destroy', $jurusan->id) }}', '{{ $jurusan->nama }}'); open = false"
                            class="flex w-full items-center gap-2 px-4 py-2 text-xs text-red-600 hover:bg-red-50 text-left">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>

            <p class="text-xs text-slate-500 mb-6 leading-relaxed min-h-[40px]">{{ Str::limit($jurusan->deskripsi, 100) }}</p>

            @php
                $kepenuhan = $jurusan->kuota > 0 ? round(($jurusan->pendaftaran_count / $jurusan->kuota) * 100) : 0;
                $barColor = 'bg-[#1e3a8a]';
                if($kepenuhan > 100) $barColor = 'bg-purple-600';
                elseif($kepenuhan > 80) $barColor = 'bg-orange-500';
                elseif($kepenuhan > 50) $barColor = 'bg-teal-500';
            @endphp

            <div class="flex justify-between text-sm mb-2">
                <div>
                    <span class="block text-xl font-bold text-slate-800">{{ $jurusan->kuota }}</span>
                    <span class="text-xs text-slate-500">Kuota</span>
                </div>
                <div class="text-center">
                    <span class="block text-xl font-bold text-slate-800">{{ $jurusan->pendaftaran_count }}</span>
                    <span class="text-xs text-slate-500">Pendaftar</span>
                </div>
                <div class="text-right">
                    <span class="block text-xl font-bold text-slate-800">{{ $kepenuhan }}%</span>
                    <span class="text-xs text-slate-500">Terisi</span>
                </div>
            </div>

            <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                <div class="{{ $barColor }} h-2 rounded-full relative overflow-hidden"
                    style="width: {{ min($kepenuhan, 100) }}%;"></div>
            </div>
            @if($kepenuhan > 100)
                <p class="text-[10px] text-amber-600 font-medium">Melebihi kuota! (+{{ $jurusan->pendaftaran_count - $jurusan->kuota }} pendaftar)</p>
            @endif
        </div>
        @empty
        <div class="col-span-2 text-center py-12 bg-white rounded-xl border border-dashed border-slate-300 text-slate-500">
            <svg class="w-12 h-12 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p>Belum ada data jurusan.</p>
        </div>
        @endforelse
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="showModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                @click="closeModal()" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div x-show="showModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <form :action="formUrl" method="POST">
                    @csrf
                    <!-- Add PUT method if editing -->
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title" x-text="isEdit ? 'Edit Jurusan' : 'Tambah Jurusan'"></h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
                                        <input type="text" name="nama" id="nama" x-model="formData.nama" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="kode" class="block text-sm font-medium text-gray-700">Kode Jurusan</label>
                                            <input type="text" name="kode" id="kode" x-model="formData.kode" required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2" placeholder="Ex: TKJ">
                                        </div>
                                        <div>
                                            <label for="kuota" class="block text-sm font-medium text-gray-700">Kuota</label>
                                            <input type="number" name="kuota" id="kuota" x-model="formData.kuota" required min="0"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" x-model="formData.deskripsi" rows="3"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2"></textarea>
                                    </div>
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select name="status" id="status" x-model="formData.status"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" @click="closeModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Critical -->
    <div x-show="showDeleteModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="showDeleteModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-red-900 bg-opacity-20 transition-opacity backdrop-blur-sm" 
                @click="closeModal()" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div x-show="showDeleteModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border-t-4 border-red-500">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Jurusan</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus jurusan <span class="font-bold text-gray-800" x-text="deleteName"></span>? 
                                    Tindakan ini tidak dapat dibatalkan dan semua data terkait akan hilang permanen.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form :action="deleteAction" method="POST" class="w-full sm:w-auto sm:ml-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                            Ya, Hapus Permanen
                        </button>
                    </form>
                    <button type="button" @click="closeModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
