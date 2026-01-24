@extends('layouts.admin')

@section('header_title', 'Tambah Calon Siswa Baru')
@section('header_subtitle', 'Daftarkan siswa baru secara manual')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.calon-siswa.index') }}" 
           class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
            <div class="flex items-center gap-2 text-red-700 font-medium mb-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Terdapat kesalahan pada inputan:</span>
            </div>
            <ul class="list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.calon-siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Form Utama -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Data Akun -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-semibold text-gray-800">Informasi Akun Pengguna</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                             <label class="block text-sm font-medium text-gray-700 mb-1">Email / Username <span class="text-red-500">*</span></label>
                             <input type="email" name="email" value="{{ old('email') }}" required
                                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                             <p class="text-xs text-gray-500 mt-1">Email digunakan untuk login.</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all"
                                placeholder="Masukkan password untuk akun siswa">
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-semibold text-gray-800">Data Pribadi Siswa</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="">- Pilih -</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                            <select name="agama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="">- Pilih -</option>
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                            <select name="golongan_darah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="">- Pilih -</option>
                                @foreach(['A', 'B', 'AB', 'O'] as $goldar)
                                    <option value="{{ $goldar }}" {{ old('golongan_darah') == $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat_rumah" rows="3" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">{{ old('alamat_rumah') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP Siswa <span class="text-red-500">*</span></label>
                            <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah <span class="text-red-500">*</span></label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-semibold text-gray-800">Data Orang Tua</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        <!-- Ayah -->
                        <div class="md:col-span-2 pb-2 border-b border-gray-100">
                            <h4 class="font-medium text-blue-600">Data Ayah</h4>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penghasilan Ayah <span class="text-red-500">*</span></label>
                            <input type="number" name="penghasilan_ayah" value="{{ old('penghasilan_ayah') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <!-- Ibu -->
                        <div class="md:col-span-2 pb-2 border-b border-gray-100 pt-2">
                            <h4 class="font-medium text-pink-600">Data Ibu</h4>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penghasilan Ibu <span class="text-red-500">*</span></label>
                            <input type="number" name="penghasilan_ibu" value="{{ old('penghasilan_ibu') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div class="md:col-span-2 pt-4">
                             <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP Orang Tua (Aktif WA) <span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp_orangtua" value="{{ old('no_hp_orangtua') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                    </div>
                </div>

                <!-- Upload Berkas -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-semibold text-gray-800">Upload Berkas Persyaratan</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 gap-6">
                        @foreach($jenisBerkas as $jb)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ $jb->nama_berkas }}
                                    @if($jb->is_wajib)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>
                                <input type="file" name="berkas_{{ $jb->id }}" 
                                    class="w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100"
                                    accept=".pdf,.jpg,.jpeg,.png">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks: 2MB.</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Pengaturan -->
            <div class="space-y-6">
                <!-- Status & Penjurusan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-semibold text-gray-800">Status & Penjurusan</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pendaftaran <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                @foreach(['draft', 'menunggu_verifikasi', 'terverifikasi', 'diterima', 'ditolak'] as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan Diminati <span class="text-red-500">*</span></label>
                            <select name="jurusan_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="">- Pilih Jurusan -</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gelombang Pendaftaran <span class="text-red-500">*</span></label>
                            <select name="gelombang_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="">- Pilih Gelombang -</option>
                                @foreach($gelombangs as $gelombang)
                                    <option value="{{ $gelombang->id }}" {{ old('gelombang_id') == $gelombang->id ? 'selected' : '' }}>
                                        {{ $gelombang->nama_gelombang }} ({{ $gelombang->is_active ? 'Aktif' : 'Non-aktif' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="border-gray-100">

                        <button type="submit" class="w-full py-2.5 bg-slate-800 text-white rounded-lg font-medium hover:bg-slate-700 shadow-sm transition-colors text-sm">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Calon Siswa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
