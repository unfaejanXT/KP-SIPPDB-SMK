@extends('layouts.admin')

@section('header_title', 'Edit Data Calon Siswa')
@section('header_subtitle', 'Perbarui informasi pendaftar')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.calon-siswa.show', $calonSiswa->id) }}" 
           class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Detail</span>
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

    <form action="{{ route('admin.calon-siswa.update', $calonSiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                             <label class="block text-sm font-medium text-gray-700 mb-1">Email / Username</label>
                             <input type="email" name="email" value="{{ old('email', $calonSiswa->user->email ?? '') }}"
                                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                             <p class="text-xs text-gray-500 mt-1">Email digunakan untuk login.</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (Opsional)</label>
                            <input type="password" name="password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all"
                                placeholder="Biarkan kosong jika tidak ingin mengubah password">
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $calonSiswa->nama_lengkap) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn', $calonSiswa->nisn) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="L" {{ old('jenis_kelamin', $calonSiswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $calonSiswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $calonSiswa->tempat_lahir) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $calonSiswa->tanggal_lahir ? $calonSiswa->tanggal_lahir->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', $calonSiswa->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                            <select name="golongan_darah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="" {{ old('golongan_darah', $calonSiswa->golongan_darah) == '' ? 'selected' : '' }}>- Pilih -</option>
                                @foreach(['A', 'B', 'AB', 'O'] as $goldar)
                                    <option value="{{ $goldar }}" {{ old('golongan_darah', $calonSiswa->golongan_darah) == $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="alamat_rumah" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">{{ old('alamat_rumah', $calonSiswa->alamat_rumah) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP Siswa</label>
                            <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $calonSiswa->nomor_hp) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $calonSiswa->asal_sekolah) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran Baju <span class="text-red-500">*</span></label>
                            <select name="ukuran_baju" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                <option value="">- Pilih -</option>
                                @foreach(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $ukuran)
                                    <option value="{{ $ukuran }}" {{ old('ukuran_baju', $calonSiswa->ukuran_baju) == $ukuran ? 'selected' : '' }}>{{ $ukuran }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Pilih ukuran baju untuk seragam sekolah</p>
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $calonSiswa->orangTua->nama_ayah ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $calonSiswa->orangTua->pekerjaan_ayah ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penghasilan Ayah</label>
                            <input type="number" name="penghasilan_ayah" value="{{ old('penghasilan_ayah', $calonSiswa->orangTua->penghasilan_ayah ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <!-- Ibu -->
                        <div class="md:col-span-2 pb-2 border-b border-gray-100 pt-2">
                            <h4 class="font-medium text-pink-600">Data Ibu</h4>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $calonSiswa->orangTua->nama_ibu ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $calonSiswa->orangTua->pekerjaan_ibu ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penghasilan Ibu</label>
                            <input type="number" name="penghasilan_ibu" value="{{ old('penghasilan_ibu', $calonSiswa->orangTua->penghasilan_ibu ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

                        <div class="md:col-span-2 pt-4">
                             <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP Orang Tua (Aktif WA)</label>
                            <input type="text" name="no_hp_orangtua" value="{{ old('no_hp_orangtua', $calonSiswa->orangTua->no_hp_orangtua ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                        </div>

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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pendaftaran</label>
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                @foreach(['draft', 'menunggu_verifikasi', 'terverifikasi', 'diterima', 'ditolak'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $calonSiswa->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan Diminati</label>
                            <select name="jurusan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $calonSiswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gelombang Pendaftaran</label>
                            <select name="gelombang_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all">
                                @foreach($gelombangs as $gelombang)
                                    <option value="{{ $gelombang->id }}" {{ old('gelombang_id', $calonSiswa->gelombang_id) == $gelombang->id ? 'selected' : '' }}>
                                        {{ $gelombang->nama_gelombang }} ({{ $gelombang->is_active ? 'Aktif' : 'Non-aktif' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="border-gray-100">

                        <button type="submit" class="w-full py-2.5 bg-slate-800 text-white rounded-lg font-medium hover:bg-slate-700 shadow-sm transition-colors text-sm">
                            <i class="fa-regular fa-floppy-disk mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
