@extends('pendaftaran.layout')

@section('form-content')
<div class="p-6 md:p-10" id="ppdb-form-container">
    {{-- Stepper Navigation --}}
    <div class="mb-10">
        <div class="relative after:absolute after:inset-x-0 after:top-1/2 after:block after:h-0.5 after:-translate-y-1/2 after:rounded-lg after:bg-gray-200">
            <ol class="relative z-10 flex justify-between text-sm font-medium text-gray-500">
                {{-- Loop for stepper --}}
                @php
                    $steps = [1 => 'Data Pribadi', 2 => 'Data Orang Tua', 3 => 'Upload Berkas', 4 => 'Konfirmasi'];
                @endphp
                @foreach($steps as $key => $label)
                    <li class="flex items-center gap-2 bg-white p-2">
                        @if($step > $key)
                            <span class="h-8 w-8 rounded-full bg-green-500 text-white flex items-center justify-center font-bold ring-4 ring-white">✓</span>
                            <span class="hidden sm:block text-green-600 font-bold">{{ $label }}</span>
                        @elseif($step == $key)
                            <span class="h-8 w-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold ring-4 ring-white">{{ $key }}</span>
                            <span class="hidden sm:block text-red-600 font-bold">{{ $label }}</span>
                        @else
                            <span class="h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold ring-4 ring-white">{{ $key }}</span>
                            <span class="hidden sm:block">{{ $label }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ $step == 4 ? route('pendaftaran.submit') : route('pendaftaran.storeStep'.$step) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- Alert Area --}}
        @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <div class="font-medium">Mohon perbaiki kesalahan berikut:</div>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
             {{ session('error') }}
        </div>
        @endif

        {{-- STEP 1: Data Pribadi --}}
        @if($step == 1)
        <div class="form-step">
            <h3 class="text-xl font-bold text-gray-900 border-b pb-4 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Data Pribadi Calon Siswa
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap --}}
                <div class="col-span-2 md:col-span-1">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Sesuai Ijazah/Akte" required value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap ?? '') }}">
                </div>

                {{-- NISN --}}
                <div class="col-span-2 md:col-span-1">
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN <span class="text-red-600">*</span></label>
                    <input type="text" name="nisn" id="nisn" maxlength="10" minlength="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="10 Digit Angka" required value="{{ old('nisn', $pendaftaran->nisn ?? '') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                    <p class="mt-1 text-xs text-gray-500">Nomor Induk Siswa Nasional harus tepat 10 digit.</p>
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir <span class="text-red-600">*</span></label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir ?? '') }}">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('tanggal_lahir', isset($pendaftaran->tanggal_lahir) ? $pendaftaran->tanggal_lahir->format('Y-m-d') : '') }}">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin <span class="text-red-600">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Agama --}}
                <div>
                    <label for="agama" class="block mb-2 text-sm font-medium text-gray-900">Agama <span class="text-red-600">*</span></label>
                    <select name="agama" id="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <option value="">Pilih Agama</option>
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agm)
                            <option value="{{ $agm }}" {{ old('agama', $pendaftaran->agama ?? '') == $agm ? 'selected' : '' }}>{{ $agm }}</option>
                        @endforeach
                    </select>
                </div>

                 {{-- Jurusan Pilihan --}}
                 <div class="col-span-2">
                    <label for="jurusan_id" class="block mb-2 text-sm font-medium text-gray-900">Kompetensi Keahlian (Jurusan) <span class="text-red-600">*</span></label>
                    <select name="jurusan_id" id="jurusan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <option value="">Pilih Jurusan yang Diminati</option>
                        @if(isset($jurusans))
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $pendaftaran->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                {{-- Golongan Darah --}}
                <div>
                    <label for="golongan_darah" class="block mb-2 text-sm font-medium text-gray-900">Golongan Darah</label>
                    <select name="golongan_darah" id="golongan_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5">
                        <option value="">-</option>
                        @foreach(['A','B','AB','O'] as $goldar)
                            <option value="{{ $goldar }}" {{ old('golongan_darah', $pendaftaran->golongan_darah ?? '') == $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nomor HP Siswa --}}
                <div>
                    <label for="nomor_hp" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP / WhatsApp <span class="text-red-600">*</span></label>
                    <input type="text" name="nomor_hp" id="nomor_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="08xxxxxxxxxx" required value="{{ old('nomor_hp', $pendaftaran->nomor_hp ?? '') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                </div>

                {{-- Asal Sekolah --}}
                <div class="col-span-2">
                    <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah (SMP/MTs) <span class="text-red-600">*</span></label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Nama Sekolah Asal" required value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah ?? '') }}">
                </div>

                {{-- Alamat Rumah --}}
                <div class="col-span-2">
                    <label for="alamat_rumah" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap <span class="text-red-600">*</span></label>
                    <textarea name="alamat_rumah" id="alamat_rumah" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Nama Jalan, RT/RW, Desa/Kelurahan, Kecamatan" required>{{ old('alamat_rumah', $pendaftaran->alamat_rumah ?? '') }}</textarea>
                </div>
            </div>
        </div>
        @endif

        {{-- STEP 2: Data Orang Tua --}}
        @if($step == 2)
        <div class="form-step">
            <h3 class="text-xl font-bold text-gray-900 border-b pb-4 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Data Orang Tua / Wali
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Data Ayah --}}
                <div class="col-span-2">
                    <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Data Ayah</h4>
                </div>
                <div>
                    <label for="nama_ayah" class="block mb-2 text-sm font-medium text-gray-900">Nama Ayah <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ayah" id="nama_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('nama_ayah', $orangtua->nama_ayah ?? '') }}">
                </div>
                <div>
                    <label for="pekerjaan_ayah" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan Ayah <span class="text-red-600">*</span></label>
                    <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('pekerjaan_ayah', $orangtua->pekerjaan_ayah ?? '') }}">
                </div>
                <div>
                    <label for="penghasilan_ayah" class="block mb-2 text-sm font-medium text-gray-900">Penghasilan Bulanan Ayah</label>
                    <input type="number" name="penghasilan_ayah" id="penghasilan_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Contoh: 2000000" value="{{ old('penghasilan_ayah', $orangtua->penghasilan_ayah ?? 0) }}">
                </div>

                {{-- Data Ibu --}}
                <div class="col-span-2 mt-4">
                    <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Data Ibu</h4>
                </div>
                <div>
                    <label for="nama_ibu" class="block mb-2 text-sm font-medium text-gray-900">Nama Ibu <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ibu" id="nama_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('nama_ibu', $orangtua->nama_ibu ?? '') }}">
                </div>
                <div>
                    <label for="pekerjaan_ibu" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan Ibu <span class="text-red-600">*</span></label>
                    <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('pekerjaan_ibu', $orangtua->pekerjaan_ibu ?? '') }}">
                </div>
                <div>
                    <label for="penghasilan_ibu" class="block mb-2 text-sm font-medium text-gray-900">Penghasilan Bulanan Ibu</label>
                    <input type="number" name="penghasilan_ibu" id="penghasilan_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Contoh: 1500000" value="{{ old('penghasilan_ibu', $orangtua->penghasilan_ibu ?? 0) }}">
                </div>

                {{-- Kontak --}}
                <div class="col-span-2 mt-4">
                     <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Kontak Orang Tua</h4>
                </div>
                <div>
                    <label for="no_hp_orangtua" class="block mb-2 text-sm font-medium text-gray-900">No. HP Orang Tua (Aktif)</label>
                    <input type="text" name="no_hp_orangtua" id="no_hp_orangtua" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_orangtua', $orangtua->no_hp_orangtua ?? '') }}">
                </div>

                {{-- Data Wali --}}
                <div class="col-span-2 mt-4">
                    <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Data Wali (Opsional)</h4>
                </div>
                <div>
                    <label for="nama_wali" class="block mb-2 text-sm font-medium text-gray-900">Nama Wali</label>
                    <input type="text" name="nama_wali" id="nama_wali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" value="{{ old('nama_wali', $orangtua->nama_wali ?? '') }}">
                </div>
                <div>
                    <label for="pekerjaan_wali" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" value="{{ old('pekerjaan_wali', $orangtua->pekerjaan_wali ?? '') }}">
                </div>
                 <div class="col-span-2">
                    <label for="alamat_wali" class="block mb-2 text-sm font-medium text-gray-900">Alamat Wali</label>
                    <textarea name="alamat_wali" id="alamat_wali" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5">{{ old('alamat_wali', $orangtua->alamat_wali ?? '') }}</textarea>
                </div>
            </div>
        </div>
        @endif

        {{-- STEP 3: Upload Berkas --}}
        @if($step == 3)
        <div class="form-step">
             <h3 class="text-xl font-bold text-gray-900 border-b pb-4 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                Upload Berkas Persyaratan
            </h3>
            
            <div class="p-4 mb-6 text-sm text-yellow-800 rounded-lg bg-yellow-50 border border-yellow-200">
                <span class="font-medium">Perhatian!</span> Pastikan dokumen yang diupload terlihat jelas, terbaca, dan dalam format (JPG/JPEG/PNG/PDF). Maksimal ukuran file 2MB per dokumen.
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Dynamic Loop for File Types --}}
                @foreach($jenisBerkas as $jb)
                
                @php
                    // Check if this specific type is uploaded based on jenis_berkas_id
                    // We need to filter $uploadedBerkas which is a collection
                    $upload = $uploadedBerkas->firstWhere('jenis_berkas_id', $jb->id);
                    $isUploaded = !empty($upload);
                    $fileUrl = $isUploaded ? asset('storage/'.$upload->file_path) : '#';
                    $name = $jb->kode_berkas;
                    $label = $jb->nama_berkas;
                    $isWajib = $jb->is_wajib;
                @endphp

                <div class="bg-white rounded-xl border {{ $isUploaded ? 'border-green-200 bg-green-50' : 'border-gray-200' }} p-5 shadow-sm transition-all duration-200 group" id="card-{{ $name }}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg {{ $isUploaded ? 'bg-green-100' : 'bg-gray-100' }} mr-3">
                                <svg class="w-6 h-6 {{ $isUploaded ? 'text-green-600' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">
                                    {{ $label }} 
                                    @if($isWajib) <span class="text-red-500 text-xs text-red-600">*</span> @endif
                                </h4>
                                <span class="text-xs text-gray-500 status-text" id="status-{{ $name }}">
                                    {{ $isUploaded ? 'Sudah diupload' . ($upload->uploaded_at ? ' (' . $upload->uploaded_at->format('d/m/Y') . ')' : '') : 'Belum ada file' }}
                                </span>
                            </div>
                        </div>
                        
                        {{-- View Button --}}
                         <a href="{{ $fileUrl }}" target="_blank" id="view-{{ $name }}" class="text-gray-400 hover:text-blue-600 transition-colors {{ $isUploaded ? '' : 'hidden' }}" title="Lihat File">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                    </div>
                    
                    <div class="relative">
                        <input class="hidden file-input" type="file" id="{{ $name }}" name="{{ $name }}" data-type="{{ $name }}">
                        <label for="{{ $name }}" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 hover:text-red-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            <span id="btn-text-{{ $name }}">Pilih / Ganti File</span>
                        </label>
                        {{-- Progress Bar (Hidden by default) --}}
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2 hidden" id="progress-container-{{ $name }}">
                            <div class="bg-red-600 h-1.5 rounded-full" style="width: 0%" id="progress-bar-{{ $name }}"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const inputs = document.querySelectorAll('.file-input');
                    
                    inputs.forEach(input => {
                        input.addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            const type = e.target.dataset.type; // This is kode_berkas
                            if (!file) return;

                            // UI Elements
                            const progressBar = document.getElementById(`progress-bar-${type}`);
                            const progressContainer = document.getElementById(`progress-container-${type}`);
                            const statusText = document.getElementById(`status-${type}`);
                            const card = document.getElementById(`card-${type}`);
                            const viewBtn = document.getElementById(`view-${type}`);
                            const btnText = document.getElementById(`btn-text-${type}`);

                            // Show progress
                            progressContainer.classList.remove('hidden');
                            statusText.innerText = 'Mengupload...';
                            statusText.classList.add('text-blue-600');
                            
                            // Form Data
                            const formData = new FormData();
                            formData.append('file', file);
                            formData.append('kode_berkas', type); // Modified: sending kode_berkas
                            formData.append('_token', '{{ csrf_token() }}');

                            // AJAX Upload
                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route('pendaftaran.upload') }}', true);

                            xhr.upload.onprogress = function(e) {
                                if (e.lengthComputable) {
                                    const percentComplete = (e.loaded / e.total) * 100;
                                    progressBar.style.width = percentComplete + '%';
                                }
                            };

                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    const response = JSON.parse(xhr.responseText);
                                    if(response.success) {
                                        // Success State
                                        statusText.innerText = 'Berhasil diupload';
                                        statusText.classList.remove('text-blue-600', 'text-gray-500');
                                        statusText.classList.add('text-green-600');
                                        
                                        card.classList.remove('border-gray-200');
                                        card.classList.add('border-green-200', 'bg-green-50');
                                        
                                        viewBtn.href = response.url;
                                        viewBtn.classList.remove('hidden');
                                        
                                        btnText.innerText = 'Ganti File';
                                    } else {
                                        alert('Gagal mengupload file: ' + response.message);
                                    }
                                } else {
                                    statusText.innerText = 'Gagal upload';
                                    statusText.classList.add('text-red-600');
                                    alert('Terjadi kesalahan saat mengupload file.');
                                }
                                // Hide progress after delay
                                setTimeout(() => {
                                    progressContainer.classList.add('hidden');
                                    progressBar.style.width = '0%';
                                }, 1000);
                            };

                            xhr.onerror = function() {
                                statusText.innerText = 'Error koneksi';
                                progressContainer.classList.add('hidden');
                            };

                            xhr.send(formData);
                        });
                    });
                });
            </script>
        </div>
        @endif
        
        {{-- STEP 4: Konfirmasi --}}
        @if($step == 4)
        <div class="form-step">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Konfirmasi Data Pendaftaran</h3>
                <p class="text-gray-500 mt-1">Mohon periksa kembali data Anda sebelum melakukan finalisasi pendaftaran.</p>
            </div>

             <div class="space-y-6">
                 {{-- Section: Data Pribadi --}}
                 <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                     <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                         <h4 class="font-bold text-gray-800 flex items-center">
                             <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                             Data Pribadi Calon Siswa
                         </h4>
                         <a href="{{ route('pendaftaran.step1') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">Ubah Data</a>
                     </div>
                     <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                         <div>
                             <p class="text-gray-500 mb-1">Nama Lengkap</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->nama_lengkap }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">NISN</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->nisn }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">Tempat, Tanggal Lahir</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->translatedFormat('d F Y') }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">Jenis Kelamin</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">Agama</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->agama }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">No. HP / WhatsApp</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->nomor_hp }}</p>
                         </div>
                         <div class="col-span-1 md:col-span-2">
                             <p class="text-gray-500 mb-1">Asal Sekolah</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->asal_sekolah }}</p>
                         </div>
                         <div class="col-span-1 md:col-span-2">
                             <p class="text-gray-500 mb-1">Alamat Rumah</p>
                             <p class="font-semibold text-gray-900">{{ $pendaftaran->alamat_rumah }}</p>
                         </div>
                         <div class="col-span-1 md:col-span-2 mt-2 pt-4 border-t border-gray-100">
                             <p class="text-gray-500 mb-1">Kompetensi Keahlian (Jurusan) Pilihan</p>
                             <p class="text-lg font-bold text-red-700">{{ $jurusan->nama ?? '-' }}</p>
                         </div>
                     </div>
                 </div>
                 
                 {{-- Section: Data Orang Tua --}}
                 <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                     <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                         <h4 class="font-bold text-gray-800 flex items-center">
                             <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                             Data Orang Tua / Wali
                         </h4>
                         <a href="{{ route('pendaftaran.step2') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">Ubah Data</a>
                     </div>
                     <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                         {{-- Ayah --}}
                         <div class="col-span-1 md:col-span-2 font-semibold text-gray-400 text-xs uppercase tracking-wider mb-2">Data Ayah</div>
                         <div>
                             <p class="text-gray-500 mb-1">Nama Ayah</p>
                             <p class="font-semibold text-gray-900">{{ $orangtua->nama_ayah }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">Pekerjaan</p>
                             <p class="font-semibold text-gray-900">{{ $orangtua->pekerjaan_ayah }}</p>
                         </div>
                         <div>
                            <p class="text-gray-500 mb-1">Penghasilan</p>
                            <p class="font-semibold text-gray-900">Rp {{ number_format($orangtua->penghasilan_ayah, 0, ',', '.') }}</p>
                        </div>

                         {{-- Ibu --}}
                         <div class="col-span-1 md:col-span-2 font-semibold text-gray-400 text-xs uppercase tracking-wider mb-2 mt-4 pt-4 border-t border-gray-100">Data Ibu</div>
                         <div>
                             <p class="text-gray-500 mb-1">Nama Ibu</p>
                             <p class="font-semibold text-gray-900">{{ $orangtua->nama_ibu }}</p>
                         </div>
                         <div>
                             <p class="text-gray-500 mb-1">Pekerjaan</p>
                             <p class="font-semibold text-gray-900">{{ $orangtua->pekerjaan_ibu }}</p>
                         </div>
                         <div>
                            <p class="text-gray-500 mb-1">Penghasilan</p>
                            <p class="font-semibold text-gray-900">Rp {{ number_format($orangtua->penghasilan_ibu, 0, ',', '.') }}</p>
                        </div>
                         
                         {{-- Kontak --}}
                         <div class="col-span-1 md:col-span-2 mt-4 pt-4 border-t border-gray-100">
                             <p class="text-gray-500 mb-1">No. HP Orang Tua</p>
                             <p class="font-semibold text-gray-900">{{ $orangtua->no_hp_orangtua ?? '-' }}</p>
                         </div>
                     </div>
                 </div>
                 
                 {{-- Section: Berkas --}}
                 <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                     <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                         <h4 class="font-bold text-gray-800 flex items-center">
                             <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                             Kelengkapan Berkas
                         </h4>
                         <a href="{{ route('pendaftaran.step3') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">Ubah Berkas</a>
                     </div>
                     <div class="p-6">
                         <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach($jenisBerkas as $jb)
                                @php
                                    $isUploaded = $uploadedBerkas->contains('jenis_berkas_id', $jb->id);
                                    $label = $jb->nama_berkas;
                                @endphp
                                <li class="flex items-center p-3 rounded-lg {{ $isUploaded ? 'bg-green-50 border border-green-100' : 'bg-gray-50 border border-gray-100' }}">
                                    @if($isUploaded)
                                        <div class="flex-shrink-0 mr-3">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                        <span class="ml-auto text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">Ada</span>
                                    @else
                                        <div class="flex-shrink-0 mr-3">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-400">{{ $label }}</span>
                                        <span class="ml-auto text-xs text-gray-500 bg-gray-200 px-2 py-1 rounded-full">Kosong</span>
                                    @endif
                                </li>
                            @endforeach
                          </ul>
                     </div>
                 </div>
                 
                 {{-- Pernyataan --}}
                 <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 flex items-start">
                    <div class="flex items-center h-5">
                        <input id="agreement" type="checkbox" required class="w-5 h-5 text-red-600 bg-white border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="agreement" class="font-medium text-gray-900 block mb-1">Pernyataan Validitas Data</label>
                        <p class="text-gray-600">Saya menyatakan bahwa data yang saya isikan pada formulir pendaftaran ini adalah BENAR dan dapat dipertanggungjawabkan. Apabila dikemudian hari ditemukan ketidaksesuaian, saya bersedia menerima konsekuensi sesuai aturan yang berlaku di sekolah.</p>
                    </div>
                </div>
             </div>
        </div>
        @endif

        {{-- Navigation Buttons --}}
        <div class="mt-8 flex justify-between pt-6 border-t border-gray-100">
            @if($step > 1)
                <a href="{{ route('pendaftaran.step'.($step-1)) }}" class="px-6 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                    &larr; Sebelumnya
                </a>
            @else
                <div class="flex-1"></div>
            @endif
            
            @if($step < 4)
                <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-center">
                    Selanjutnya &rarr;
                </button>
            @else
                <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg text-center">
                    Kirim Pendaftaran
                </button>
            @endif
        </div>
    </form>
</div>
@endsection
