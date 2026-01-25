@extends('layouts.student')

@section('title', 'Edit Data Orang Tua - SMK SBI')
@section('header_title', 'Edit Data Orang Tua')
@section('header_subtitle', 'Perbarui data orang tua/wali siswa')

@section('content')
<div class="flex gap-2 mb-6 border-b border-gray-200">
    <a href="{{ route('pendaftaran.edit') }}" class="px-6 py-3 text-sm font-medium text-slate-500 hover:text-slate-700 border-b-2 border-transparent hover:border-gray-300 transition-colors">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Data Pribadi
        </div>
    </a>
    <button class="px-6 py-3 text-sm font-medium border-b-2 border-slate-800 text-slate-800">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Data Orang Tua
        </div>
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showConfirmModal: false }">
    <div class="p-6 border-b border-gray-50">
        <h3 class="text-lg font-bold text-slate-800">Data Orang Tua / Wali</h3>
        <p class="text-slate-500 text-sm mt-1">Lengkapi informasi mengenai orang tua atau wali siswa.</p>
    </div>

    @if ($errors->any())
        <div class="p-6 bg-red-50 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if(session('success'))
        <div class="p-6 bg-green-50 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="p-6 bg-red-50 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <form x-ref="form" action="{{ route('pendaftaran.update.orangtua') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        @if(isset($isLocked) && $isLocked)
            <div class="mb-6 p-4 bg-yellow-50 text-yellow-800 rounded-lg border border-yellow-200">
                <p><strong>Perhatian:</strong> Data tidak dapat diubah karena pendaftaran Anda sudah diproses.</p>
            </div>
            <fieldset disabled>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            
            <!-- Data Ayah -->
            <div class="md:col-span-2 pb-2 border-b border-gray-100">
                <h4 class="font-semibold text-slate-700">Data Ayah</h4>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Nama Ayah</label>
                <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $pendaftaran->orangTua->nama_ayah ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $pendaftaran->orangTua->pekerjaan_ayah ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Penghasilan Ayah (Bulanan)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500 text-sm">Rp</span>
                    <input type="number" name="penghasilan_ayah" value="{{ old('penghasilan_ayah', $pendaftaran->orangTua->penghasilan_ayah ?? 0) }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
                </div>
            </div>

             <!-- Divider -->
             <div class="md:col-span-2 pb-2 border-b border-gray-100 mt-4">
                <h4 class="font-semibold text-slate-700">Data Ibu</h4>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Nama Ibu</label>
                <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $pendaftaran->orangTua->nama_ibu ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $pendaftaran->orangTua->pekerjaan_ibu ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Penghasilan Ibu (Bulanan)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500 text-sm">Rp</span>
                    <input type="number" name="penghasilan_ibu" value="{{ old('penghasilan_ibu', $pendaftaran->orangTua->penghasilan_ibu ?? 0) }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
                </div>
            </div>

            <!-- Kontak Orang Tua -->
            <div class="md:col-span-2 pb-2 border-b border-gray-100 mt-4">
                <h4 class="font-semibold text-slate-700">Kontak Orang Tua</h4>
            </div>
             <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">No. HP Orang Tua (Aktif)</label>
                <input type="tel" name="no_hp_orangtua" value="{{ old('no_hp_orangtua', $pendaftaran->orangTua->no_hp_orangtua ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm" placeholder="Contoh: 081234567890">
            </div>


            <!-- Data Wali (Opsional) -->
            <div class="md:col-span-2 pb-2 border-b border-gray-100 mt-4">
                <h4 class="font-semibold text-slate-700">Data Wali (Opsional)</h4>
                <p class="text-xs text-slate-500">Isi jika siswa tinggal dengan wali.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Nama Wali</label>
                <input type="text" name="nama_wali" value="{{ old('nama_wali', $pendaftaran->orangTua->nama_wali ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Pekerjaan Wali</label>
                <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $pendaftaran->orangTua->pekerjaan_wali ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Penghasilan Wali (Bulanan)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500 text-sm">Rp</span>
                    <input type="number" name="penghasilan_wali" value="{{ old('penghasilan_wali', $pendaftaran->orangTua->penghasilan_wali ?? 0) }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">No. HP Wali</label>
                <input type="tel" name="no_hp_wali" value="{{ old('no_hp_wali', $pendaftaran->orangTua->no_hp_wali ?? '') }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-600 mb-2">Alamat Wali</label>
                <textarea name="alamat_wali" rows="3"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm resize-none">{{ old('alamat_wali', $pendaftaran->orangTua->alamat_wali ?? '') }}</textarea>
            </div>

        </div>

        @if(isset($isLocked) && $isLocked)
            </fieldset>
        @else
        <div class="mt-8 flex justify-end">
            <button type="button" @click="showConfirmModal = true"
                class="bg-[#1e3a8a] hover:bg-blue-900 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
        @endif

    </form>

    <!-- Confirm Modal -->
    <div x-show="showConfirmModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showConfirmModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                @click="showConfirmModal = false" aria-hidden="true"></div>

            <div x-show="showConfirmModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Simpan Perubahan?</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menyimpan perubahan data orang tua/wali ini? Pastikan data yang Anda masukkan sudah benar.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click="$refs.form.submit()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Ya, Simpan
                    </button>
                    <button type="button" @click="showConfirmModal = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="h-8"></div>
@endsection
