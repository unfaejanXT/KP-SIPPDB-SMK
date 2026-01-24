@extends('layouts.admin')

@section('header_title', 'Detail Calon Siswa')
@section('header_subtitle', 'Lihat informasi lengkap pendaftar')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.calon-siswa.index') }}" 
           class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
        <div class="flex gap-2">
            <a href="{{ route('admin.calon-siswa.edit', $calonSiswa->id) }}" 
               class="flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-lg text-sm font-medium hover:bg-amber-600 transition-colors shadow-sm">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Edit Data</span>
            </a>
            <button type="button" onclick="openDeleteModal('{{ route('admin.calon-siswa.destroy', $calonSiswa->id) }}')"
                    class="flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors shadow-sm">
                <i class="fa-regular fa-trash-can"></i>
                <span>Hapus</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Info Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Akun -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-semibold text-gray-800">Informasi Akun Pengguna</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Email / Username</label>
                            <div class="text-base font-semibold text-gray-800">{{ $calonSiswa->user->email ?? '-' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Status Akun</label>
                            <div>
                                @if($calonSiswa->user)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $calonSiswa->user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $calonSiswa->user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-500">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pribadi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-semibold text-gray-800">Data Pribadi Siswa</h3>
                    <span class="text-xs text-gray-500 font-mono">ID: {{ $calonSiswa->id }}</span>
                </div>
                <div class="p-6">
                    <div class="flex items-start gap-6 mb-6">
                        <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-2xl font-bold border border-slate-200">
                            {{ substr($calonSiswa->nama_lengkap ?? '?', 0, 2) }}
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-800">{{ $calonSiswa->nama_lengkap }}</h2>
                            <p class="text-gray-500 text-sm mb-2">{{ $calonSiswa->nisn }}</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $calonSiswa->jurusan->nama_jurusan ?? '-' }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded text-xs font-medium bg-purple-50 text-purple-600 border border-purple-100">
                                    {{ $calonSiswa->gelombang->nama_gelombang ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Jenis Kelamin</label>
                            <div class="text-sm font-medium text-gray-700">
                                {{ $calonSiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</label>
                            <div class="text-sm font-medium text-gray-700">
                                {{ $calonSiswa->tempat_lahir }}, {{ $calonSiswa->tanggal_lahir ? $calonSiswa->tanggal_lahir->format('d F Y') : '-' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Agama</label>
                            <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->agama }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Golongan Darah</label>
                            <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->golongan_darah ?? '-' }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                            <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->alamat_rumah }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Asal Sekolah</label>
                            <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->asal_sekolah }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Nomor HP</label>
                            <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->nomor_hp }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-semibold text-gray-800">Data Orang Tua / Wali</h3>
                </div>
                <div class="p-6">
                    @if($calonSiswa->orangTua)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                            <!-- Ayah -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-blue-600 border-b border-blue-50 pb-2">Informasi Ayah</h4>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Nama Ayah</label>
                                    <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->orangTua->nama_ayah }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Pekerjaan</label>
                                    <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->orangTua->pekerjaan_ayah }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Penghasilan</label>
                                    <div class="text-sm font-medium text-gray-700">Rp {{ number_format($calonSiswa->orangTua->penghasilan_ayah, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <!-- Ibu -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-pink-600 border-b border-pink-50 pb-2">Informasi Ibu</h4>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Nama Ibu</label>
                                    <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->orangTua->nama_ibu }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Pekerjaan</label>
                                    <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->orangTua->pekerjaan_ibu }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Penghasilan</label>
                                    <div class="text-sm font-medium text-gray-700">Rp {{ number_format($calonSiswa->orangTua->penghasilan_ibu, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="md:col-span-2 pt-4 border-t border-gray-100">
                                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Nomor HP Orang Tua</label>
                                <div class="text-sm font-medium text-gray-700">{{ $calonSiswa->orangTua->no_hp_orangtua }}</div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-400">
                            <i class="fa-solid fa-users-slash text-3xl mb-2"></i>
                            <p>Data orang tua belum dilengkapi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Status & File -->
        <div class="space-y-6">
            <!-- Status Pendaftaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-semibold text-gray-800">Status Pendaftaran</h3>
                </div>
                <div class="p-6">
                    <div class="mb-4 text-center">
                        @php
                            $status = strtolower($calonSiswa->status);
                            $badgeClass = match($status) {
                                'terverifikasi', 'diterima' => 'bg-emerald-100 text-emerald-700',
                                'ditolak' => 'bg-red-100 text-red-700',
                                default => 'bg-amber-100 text-amber-700',
                            };
                            $displayStatus = ucfirst($status);
                            if(in_array($status, ['menunggu', 'draft', 'menunggu_verifikasi'])) $displayStatus = 'Menunggu Verifikasi';
                        @endphp
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $badgeClass }}">
                            {{ ucfirst($calonSiswa->status) }}
                        </span>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                            <span class="text-gray-500">Tanggal Daftar</span>
                            <span class="font-medium text-gray-700">{{ $calonSiswa->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                            <span class="text-gray-500">Terakhir Update</span>
                            <span class="font-medium text-gray-700">{{ $calonSiswa->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berkas / Dokumen -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-semibold text-gray-800">Berkas Upload</h3>
                </div>
                <div class="p-4">
                    @forelse($calonSiswa->berkas as $berkas)
                        <div class="flex items-center gap-3 p-3 mb-2 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 rounded bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                                <i class="fa-regular fa-file-pdf"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">
                                    {{ $berkas->jenisBerkas->nama ?? 'Dokumen' }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] uppercase font-bold {{ $berkas->status_verifikasi == 'verified' ? 'text-emerald-600' : ($berkas->status_verifikasi == 'ditolak' ? 'text-red-600' : 'text-amber-600') }}">
                                        {{ $berkas->status_verifikasi ?? 'Pending' }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $berkas->file_path) }}" target="_blank"
                               class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors" title="Lihat File">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400">
                            <i class="fa-regular fa-folder-open text-2xl mb-2"></i>
                            <p class="text-sm">Belum ada berkas.</p>
                        </div>
                    @endforelse
                    
                    @if($calonSiswa->berkas->isNotEmpty())
                    <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                        <a href="{{ route('admin.verifikasi.show', $calonSiswa->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                            Kelola Verifikasi Berkas &rarr;
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/50 transition-opacity backdrop-blur-sm"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Hapus Data Calon Siswa</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus data calon siswa ini?
                                </p>
                                <div class="mt-3 rounded-md bg-red-50 p-3 border border-red-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fa-solid fa-circle-exclamation text-red-600 text-sm"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-800">
                                                PERINGATAN!
                                            </p>
                                            <p class="text-xs text-red-700 mt-1">
                                                Akun pengguna yang terkait juga akan <strong>DIHAPUS PERMANEN</strong> dan tidak dapat dipulihkan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-colors">
                            Ya, Hapus Permanen
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openDeleteModal(url) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this || e.target.querySelector('.backdrop-blur-sm') === e.target) {
           closeDeleteModal();
        }
    });
</script>
@endpush
