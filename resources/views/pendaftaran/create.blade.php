@extends('pendaftaran.layout')

@section('form-content')
<div class="p-6 md:p-10" id="ppdb-form-container">
    {{-- Stepper Navigation --}}
    <div class="mb-10">
        <div class="relative after:absolute after:inset-x-0 after:top-1/2 after:block after:h-0.5 after:-translate-y-1/2 after:rounded-lg after:bg-gray-200">
            <ol class="relative z-10 flex justify-between text-sm font-medium text-gray-500">
                <li class="flex items-center gap-2 bg-white p-2">
                    <span class="step-indicator h-8 w-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold ring-4 ring-white" id="step-indicator-1">1</span>
                    <span class="hidden sm:block text-red-600 font-bold" id="step-label-1">Data Pribadi</span>
                </li>
                <li class="flex items-center gap-2 bg-white p-2">
                    <span class="step-indicator h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold ring-4 ring-white" id="step-indicator-2">2</span>
                    <span class="hidden sm:block" id="step-label-2">Data Orang Tua</span>
                </li>
                <li class="flex items-center gap-2 bg-white p-2">
                    <span class="step-indicator h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold ring-4 ring-white" id="step-indicator-3">3</span>
                    <span class="hidden sm:block" id="step-label-3">Upload Berkas</span>
                </li>
                <li class="flex items-center gap-2 bg-white p-2">
                    <span class="step-indicator h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold ring-4 ring-white" id="step-indicator-4">4</span>
                    <span class="hidden sm:block" id="step-label-4">Selesai</span>
                </li>
            </ol>
        </div>
    </div>

    {{-- Form --}}
    <form action="" method="POST" enctype="multipart/form-data" id="ppdbForm">
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

        {{-- STEP 1: Data Pribadi --}}
        <div class="form-step" id="step-1">
            <h3 class="text-xl font-bold text-gray-900 border-b pb-4 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Data Pribadi Calon Siswa
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap --}}
                <div class="col-span-2 md:col-span-1">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Sesuai Ijazah/Akte" required value="{{ old('nama_lengkap') }}">
                </div>

                {{-- NISN --}}
                <div class="col-span-2 md:col-span-1">
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN <span class="text-red-600">*</span></label>
                    <input type="text" name="nisn" id="nisn" maxlength="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="10 Digit Angka" required value="{{ old('nisn') }}">
                    <p class="mt-1 text-xs text-gray-500">Nomor Induk Siswa Nasional harus 10 digit.</p>
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir <span class="text-red-600">*</span></label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('tempat_lahir') }}">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('tanggal_lahir') }}">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin <span class="text-red-600">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Agama --}}
                <div>
                    <label for="agama" class="block mb-2 text-sm font-medium text-gray-900">Agama <span class="text-red-600">*</span></label>
                    <select name="agama" id="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <option value="">Pilih Agama</option>
                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                 {{-- Jurusan Pilihan --}}
                 <div class="col-span-2">
                    <label for="jurusan_id" class="block mb-2 text-sm font-medium text-gray-900">Kompetensi Keahlian (Jurusan) <span class="text-red-600">*</span></label>
                    <select name="jurusan_id" id="jurusan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <option value="">Pilih Jurusan yang Diminati</option>
                        @if(isset($jurusans))
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                            @endforeach
                        @else
                             {{-- Fallback if variable is missing during dev --}}
                             <option value="1">Teknik Komputer & Jaringan</option>
                             <option value="2">Akuntansi</option>
                             <option value="3">Manajemen Perkantoran</option>
                        @endif
                    </select>
                </div>

                {{-- Golongan Darah --}}
                <div>
                    <label for="golongan_darah" class="block mb-2 text-sm font-medium text-gray-900">Golongan Darah</label>
                    <select name="golongan_darah" id="golongan_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5">
                        <option value="">-</option>
                        <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                </div>

                {{-- Nomor HP Siswa --}}
                <div>
                    <label for="nomor_hp" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP / WhatsApp <span class="text-red-600">*</span></label>
                    <input type="text" name="nomor_hp" id="nomor_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="08xxxxxxxxxx" required value="{{ old('nomor_hp') }}">
                </div>

                {{-- Asal Sekolah --}}
                <div class="col-span-2">
                    <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah (SMP/MTs) <span class="text-red-600">*</span></label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Nama Sekolah Asal" required value="{{ old('asal_sekolah') }}">
                </div>

                {{-- Alamat Rumah --}}
                <div class="col-span-2">
                    <label for="alamat_rumah" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap <span class="text-red-600">*</span></label>
                    <textarea name="alamat_rumah" id="alamat_rumah" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Nama Jalan, RT/RW, Desa/Kelurahan, Kecamatan" required>{{ old('alamat_rumah') }}</textarea>
                </div>
            </div>
        </div>

        {{-- STEP 2: Data Orang Tua --}}
        <div class="form-step hidden" id="step-2">
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
                    <input type="text" name="nama_ayah" id="nama_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('nama_ayah') }}">
                </div>
                <div>
                    <label for="pekerjaan_ayah" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan Ayah <span class="text-red-600">*</span></label>
                    <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('pekerjaan_ayah') }}">
                </div>
                <div>
                    <label for="penghasilan_ayah" class="block mb-2 text-sm font-medium text-gray-900">Penghasilan Bulanan Ayah</label>
                    <input type="number" name="penghasilan_ayah" id="penghasilan_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Contoh: 2000000" value="{{ old('penghasilan_ayah', 0) }}">
                </div>

                {{-- Data Ibu --}}
                <div class="col-span-2 mt-4">
                    <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Data Ibu</h4>
                </div>
                <div>
                    <label for="nama_ibu" class="block mb-2 text-sm font-medium text-gray-900">Nama Ibu <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ibu" id="nama_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('nama_ibu') }}">
                </div>
                <div>
                    <label for="pekerjaan_ibu" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan Ibu <span class="text-red-600">*</span></label>
                    <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required value="{{ old('pekerjaan_ibu') }}">
                </div>
                <div>
                    <label for="penghasilan_ibu" class="block mb-2 text-sm font-medium text-gray-900">Penghasilan Bulanan Ibu</label>
                    <input type="number" name="penghasilan_ibu" id="penghasilan_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Contoh: 1500000" value="{{ old('penghasilan_ibu', 0) }}">
                </div>

                {{-- Kontak --}}
                <div class="col-span-2 mt-4">
                     <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Kontak Orang Tua</h4>
                </div>
                <div>
                    <label for="no_hp_orangtua" class="block mb-2 text-sm font-medium text-gray-900">No. HP Orang Tua (Aktif)</label>
                    <input type="text" name="no_hp_orangtua" id="no_hp_orangtua" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_orangtua') }}">
                </div>

                {{-- Data Wali --}}
                <div class="col-span-2 mt-4">
                    <h4 class="font-semibold text-gray-700 bg-gray-100 p-2 rounded mb-4">Data Wali (Opsional)</h4>
                </div>
                <div>
                    <label for="nama_wali" class="block mb-2 text-sm font-medium text-gray-900">Nama Wali</label>
                    <input type="text" name="nama_wali" id="nama_wali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" value="{{ old('nama_wali') }}">
                </div>
                <div>
                    <label for="pekerjaan_wali" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" value="{{ old('pekerjaan_wali') }}">
                </div>
                 <div class="col-span-2">
                    <label for="alamat_wali" class="block mb-2 text-sm font-medium text-gray-900">Alamat Wali</label>
                    <textarea name="alamat_wali" id="alamat_wali" rows="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5">{{ old('alamat_wali') }}</textarea>
                </div>
            </div>
        </div>

        {{-- STEP 3: Upload Berkas --}}
        <div class="form-step hidden" id="step-3">
             <h3 class="text-xl font-bold text-gray-900 border-b pb-4 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                Upload Berkas Persyaratan
            </h3>
            
            <div class="p-4 mb-6 text-sm text-yellow-800 rounded-lg bg-yellow-50 border border-yellow-200">
                <span class="font-medium">Perhatian!</span> Pastikan dokumen yang diupload terlihat jelas, terbaca, dan dalam format (JPG/JPEG/PNG/PDF). Maksimal ukuran file 2MB per dokumen.
            </div>

            <div class="space-y-6">
                {{-- Upload Pas Foto --}}
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="pas_foto">Pas Foto Resmi (3x4/4x6) <span class="text-red-600">*</span></label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" id="pas_foto" name="pas_foto" type="file" required>
                    <p class="mt-1 text-xs text-gray-500">Foto resmi latar belakang merah/biru.</p>
                </div>

                {{-- Upload KK --}}
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="berkas_kk">Kartu Keluarga (KK) <span class="text-red-600">*</span></label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" id="berkas_kk" name="berkas_kk" type="file" required>
                </div>
                
                {{-- Upload Akta --}}
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="berkas_akta_kelahiran">Akta Kelahiran <span class="text-red-600">*</span></label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" id="berkas_akta_kelahiran" name="berkas_akta_kelahiran" type="file" required>
                </div>
                
                {{-- Upload Ijazah/SKL --}}
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="berkas_ijazah">Ijazah / SKL (Surat Keterangan Lulus) <span class="text-red-600">*</span></label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" id="berkas_ijazah" name="berkas_ijazah" type="file" required>
                </div>

                 {{-- Upload KTP Orang Tua --}}
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="berkas_ktp_orangtua">KTP Orang Tua / Wali <span class="text-red-600">*</span></label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" id="berkas_ktp_orangtua" name="berkas_ktp_orangtua" type="file" required>
                </div>

                {{-- Upload KIP --}}
                 <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="berkas_kip">KIP / PKH / KKS (Jika Ada)</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" id="berkas_kip" name="berkas_kip" type="file">
                    <p class="mt-1 text-xs text-gray-500">Opsional. Upload jika memiliki kartu bantuan sosial.</p>
                </div>
            </div>
        </div>

         {{-- STEP 4: Konfirmasi (Visual only before submit) - or handled by Step 3 Submit --}}
         {{-- I'll make Submit button available on Step 3, Step 4 is usually success message after redirect --}}
         
        {{-- Navigation Buttons --}}
        <div class="mt-8 flex justify-between pt-6 border-t border-gray-100">
            <button type="button" id="prevBtn" class="hidden px-6 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                &larr; Sebelumnya
            </button>
            <div class="flex-1"></div>
            <button type="button" id="nextBtn" class="px-6 py-2.5 text-sm font-medium text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-center">
                Selanjutnya &rarr;
            </button>
            <button type="submit" id="submitBtn" class="hidden px-6 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg text-center">
                Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentStep = 1;
        const totalSteps = 3; // Step 4 is success state usually handled by controller redirect

        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('ppdbForm');

        function updateStepUI(step) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(el => el.classList.add('hidden'));
            // Show current step
            document.getElementById(`step-${step}`).classList.remove('hidden');

            // Update Header Indicators
            for(let i=1; i<=4; i++) {
                const indicator = document.getElementById(`step-indicator-${i}`);
                const label = document.getElementById(`step-label-${i}`);
                
                if(i < step) {
                    // Completed
                    indicator.classList.remove('bg-gray-200', 'text-gray-600', 'bg-red-600', 'text-white');
                    indicator.classList.add('bg-green-500', 'text-white');
                    indicator.innerHTML = '✓';
                    label.classList.add('text-green-600');
                    label.classList.remove('text-red-600', 'text-gray-500');
                } else if (i === step) {
                    // Active
                    indicator.classList.remove('bg-gray-200', 'text-gray-600', 'bg-green-500', 'text-white');
                    indicator.classList.add('bg-red-600', 'text-white');
                    indicator.innerHTML = i;
                    label.classList.add('text-red-600', 'font-bold');
                    label.classList.remove('text-green-600', 'text-gray-500');
                } else {
                    // Pending
                    indicator.classList.remove('bg-red-600', 'text-white', 'bg-green-500');
                    indicator.classList.add('bg-gray-200', 'text-gray-600');
                    indicator.innerHTML = i;
                    label.classList.remove('text-red-600', 'text-green-600', 'font-bold');
                    label.classList.add('text-gray-500');
                }
            }

            // Buttons visibility
            if (step === 1) {
                prevBtn.classList.add('hidden');
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            } else if (step === totalSteps) {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            }
            
            // Scroll to top of form
            const container = document.getElementById('ppdb-form-container');
            if(container) container.scrollIntoView({behavior: 'smooth'});
        }

        function validateStep(step) {
            const stepEl = document.getElementById(`step-${step}`);
            const inputs = stepEl.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    // Optional: Add shake animation or error message
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                alert('Mohon lengkapi semua bidang yang wajib diisi.');
            }
            return isValid;
        }

        nextBtn.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStepUI(currentStep);
                }
            }
        });

        prevBtn.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                updateStepUI(currentStep);
            }
        });

        // Initialize
        updateStepUI(currentStep);
    });
</script>
@endsection
