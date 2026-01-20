@extends('layouts.student')

@section('title', 'Edit Pendaftaran - SMK SBI')
@section('header_title', 'Edit Pendaftaran')
@section('header_subtitle', 'Perbarui data pendaftaran Anda')

@section('content')
<div class="flex gap-2 mb-6 border-b border-gray-200">
    <button class="px-6 py-3 text-sm font-medium border-b-2 border-slate-800 text-slate-800">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Data Pribadi
        </div>
    </button>
    <button disabled
        class="px-6 py-3 text-sm font-medium text-slate-500 hover:text-slate-700 border-b-2 border-transparent hover:border-gray-300 transition-colors opacity-50 cursor-not-allowed">
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

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-50">
        <h3 class="text-lg font-bold text-slate-800">Data Pribadi Calon Siswa</h3>
        <p class="text-slate-500 text-sm mt-1">Edit informasi data diri Anda</p>
    </div>

    @if ($errors->any())
        <div class="p-6 bg-red-50 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendaftaran.update') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">NISN</label>
                <input type="text" name="nisn" value="{{ $pendaftaran->nisn }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm"
                    readonly>
                 <p class="text-xs text-slate-400 mt-1">NISN tidak dapat diubah.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Jenis Kelamin</label>
                <div class="relative">
                    <select name="jenis_kelamin"
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm appearance-none">
                        <option value="L" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Tanggal Lahir</label>
                <div class="relative">
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir ? $pendaftaran->tanggal_lahir->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Agama</label>
                <div class="relative">
                    <select name="agama"
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm appearance-none">
                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama', $pendaftaran->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Nomor HP</label>
                <input type="tel" name="nomor_hp" value="{{ old('nomor_hp', $pendaftaran->nomor_hp) }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Jurusan Pilihan</label>
                <div class="relative">
                    <select name="jurusan_id"
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm appearance-none">
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $pendaftaran->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-600 mb-2">Alamat Lengkap</label>
                <textarea name="alamat_rumah" rows="3"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm resize-none">{{ old('alamat_rumah', $pendaftaran->alamat_rumah) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-600 mb-2">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah) }}"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-slate-800 text-sm">
            </div>

        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit"
                class="bg-[#1e3a8a] hover:bg-blue-900 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

<div class="h-8"></div>
@endsection
