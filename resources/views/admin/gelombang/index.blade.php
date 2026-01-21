@extends('layouts.admin')

@section('title', 'Gelombang Pendaftaran - PPDB SMK SBI')
@section('header_title', 'Gelombang Pendaftaran')
@section('header_subtitle', 'Kelola periode dan kuota pendaftaran')

@section('content')
<div x-data="{ 
    showModal: false, 
    isEdit: false, 
    formUrl: '', 
    formData: {
        id: null,
        nama: '',
        tahun_ajaran: '',
        tanggal_mulai: '',
        tanggal_selesai: '',
        kuota: 0,
        is_active: true
    },
    openAddModal() {
        this.isEdit = false;
        this.formUrl = '{{ route('admin.gelombang.store') }}';
        this.formData = {
            id: null,
            nama: '',
            tahun_ajaran: '{{ date('Y') }}/{{ date('Y')+1 }}',
            tanggal_mulai: '',
            tanggal_selesai: '',
            kuota: 0,
            is_active: true
        };
        this.showModal = true;
    },
    openEditModal(item) {
        this.isEdit = true;
        this.formUrl = '{{ route('admin.gelombang.update', ':id') }}'.replace(':id', item.id);
        this.formData = {
            id: item.id,
            nama: item.nama,
            tahun_ajaran: item.tahun_ajaran,
            tanggal_mulai: item.tanggal_mulai ? item.tanggal_mulai.split('T')[0] : '',
            tanggal_selesai: item.tanggal_selesai ? item.tanggal_selesai.split('T')[0] : '',
            kuota: item.kuota,
            is_active: item.is_active
        };
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
    }
}">

    <!-- Top Action Bar -->
    <div class="flex justify-between items-center mb-8">
        @if($sedangAktif > 0)
        <div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            {{ $sedangAktif }} Gelombang Aktif
        </div>
        @else
        <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-100 text-slate-500 rounded-full text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
            Tidak ada gelombang aktif
        </div>
        @endif

        <button @click="openAddModal()"
            class="flex items-center gap-2 bg-[#1e293b] hover:bg-[#0f172a] text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                </path>
            </svg>
            Tambah Gelombang
        </button>
    </div>

    <!-- Alert Success/Error -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
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

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @forelse($gelombang as $item)
            @php
                $isActive = $item->is_active && $item->isBerlaku();
                // Determine styling based on status
                if ($isActive) {
                    $cardBorder = 'border-emerald-400 ring-1 ring-emerald-400/30 shadow-[0_4px_20px_-5px_rgba(16,185,129,0.15)]';
                    $badgeClass = 'bg-emerald-100 text-emerald-600 border border-emerald-200';
                    $badgeText = 'Aktif';
                    $progressColor = 'bg-emerald-500';
                } elseif (now() > $item->tanggal_selesai) {
                    $cardBorder = 'border-slate-200 shadow-sm hover:shadow-md';
                    $badgeClass = 'bg-slate-100 text-slate-500 border border-slate-200';
                    $badgeText = 'Selesai';
                    $progressColor = 'bg-[#1e293b]';
                } else {
                    // Future or Inactive manually
                    $cardBorder = 'border-slate-200 shadow-sm hover:shadow-md';
                    $badgeClass = 'bg-blue-50 text-blue-500 border border-blue-100';
                    $badgeText = 'Akan Datang';
                    if (!$item->is_active) $badgeText = 'Nonaktif';
                    $progressColor = 'bg-blue-500';
                }

                $pendaftarCount = $item->pendaftarans_count;
                $kuota = $item->kuota;
                $persenTerisi = $kuota > 0 ? round(($pendaftarCount / $kuota) * 100) : 0;
                $sisa = max(0, $kuota - $pendaftarCount);
            @endphp

            <div class="bg-white rounded-xl p-6 relative transition-shadow {{ $cardBorder }}">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">{{ $item->nama }}</h3>
                        <span class="inline-block mt-1 px-2.5 py-0.5 rounded text-[10px] font-bold {{ $badgeClass }}">
                            {{ $badgeText }}
                        </span>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                        <div x-show="open"
                            style="display: none;"
                            class="absolute right-0 top-6 w-32 bg-white border border-slate-100 shadow-xl rounded-lg py-1 z-10">
                            <button @click="openEditModal({{ $item }}); open = false"
                                class="flex w-full items-center gap-2 px-4 py-2 text-xs text-slate-600 hover:bg-slate-50">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('admin.gelombang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gelombang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex w-full items-center gap-2 px-4 py-2 text-xs text-red-600 hover:bg-red-50">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center text-sm text-slate-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $item->tanggal_mulai->format('d M') }} - {{ $item->tanggal_selesai->format('d M Y') }}
                    </div>
                    <div class="flex items-center text-sm text-slate-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        {{ $pendaftarCount }} / {{ $kuota }} pendaftar
                    </div>

                    <div>
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-slate-400">Terisi</span>
                            <span class="font-bold text-slate-800">{{ $persenTerisi }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="{{ $progressColor }} h-2 rounded-full" style="width: {{ min($persenTerisi, 100) }}%"></div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-xs text-slate-400">Sisa Kuota <b class="text-slate-800 ml-1">{{ $sisa }} siswa</b></span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-dashed border-slate-300 text-slate-500">
                <p>Belum ada gelombang pendaftaran.</p>
            </div>
        @endforelse
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-slate-800">{{ $totalGelombang }}</h4>
                <p class="text-xs text-slate-500 font-medium">Total Gelombang</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-slate-800">{{ $sedangAktif }}</h4>
                <p class="text-xs text-slate-500 font-medium">Sedang Aktif</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-cyan-50 rounded-lg flex items-center justify-center text-cyan-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-slate-800">{{ $totalKuota }}</h4>
                <p class="text-xs text-slate-500 font-medium">Total Kuota</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-slate-800">{{ $sisaKuota }}</h4>
                <p class="text-xs text-slate-500 font-medium">Sisa Kuota</p>
            </div>
        </div>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title" x-text="isEdit ? 'Edit Gelombang' : 'Tambah Gelombang'"></h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Gelombang</label>
                                        <input type="text" name="nama" id="nama" x-model="formData.nama" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                    </div>
                                    <div>
                                        <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" x-model="formData.tahun_ajaran" required placeholder="2024/2025"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" x-model="formData.tanggal_mulai" required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                        </div>
                                        <div>
                                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" x-model="formData.tanggal_selesai" required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="kuota" class="block text-sm font-medium text-gray-700">Kuota</label>
                                            <input type="number" name="kuota" id="kuota" x-model="formData.kuota" required min="0"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                        </div>
                                        <div class="flex items-center pt-6">
                                            <input type="checkbox" name="is_active" id="is_active" x-model="formData.is_active" value="1"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                                Aktifkan Gelombang
                                            </label>
                                        </div>
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
</div>
@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
