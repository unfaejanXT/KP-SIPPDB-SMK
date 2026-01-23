@extends('layouts.admin')

@section('title', 'Buat Pengumuman Baru - PPDB SMK SBI')

@section('header_title', 'Buat Pengumuman')
@section('header_subtitle', 'Tulis informasi terbaru untuk calon siswa')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="p-8">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul Pengumuman</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-slate-700"
                        placeholder="Contoh: Pembukaan Pendaftaran Gelombang 2">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori" id="kategori" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-slate-700 appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]"
                            style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C/polyline%3E%3C/svg%3E');">
                            <option value="Informasi" {{ old('kategori') == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                            <option value="Hasil Seleksi" {{ old('kategori') == 'Hasil Seleksi' ? 'selected' : '' }}>Hasil Seleksi</option>
                            <option value="Jadwal" {{ old('kategori') == 'Jadwal' ? 'selected' : '' }}>Jadwal</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                        <select name="status" id="status" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-slate-700 appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]"
                            style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2364748b%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C/polyline%3E%3C/svg%3E');">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Langsung Publikasikan</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Target Pengguna</label>
                    <div class="flex flex-wrap gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        @foreach($targets as $role => $label)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="target_roles[]" value="{{ $role }}" 
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    {{ (is_array(old('target_roles')) && in_array($role, old('target_roles'))) || ($role === 'public' && !old('target_roles')) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Jika "Umum" dipilih, pengumuman akan terlihat oleh semua pengunjung tanpa login.</p>
                </div>

                <div>
                    <label for="konten" class="block text-sm font-semibold text-slate-700 mb-2">Isi Pengumuman</label>
                    <textarea name="konten" id="konten" rows="8" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-slate-700"
                        placeholder="Tuliskan isi pengumuman secara detail di sini...">{{ old('konten') }}</textarea>
                    @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="flex items-center h-5">
                        <input id="is_pinned" name="is_pinned" type="checkbox" value="1" {{ old('is_pinned') ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </div>
                    <div class="ml-1 text-sm">
                        <label for="is_pinned" class="font-semibold text-blue-900">Sematkan Pengumuman</label>
                        <p class="text-blue-700">Pengumuman ini akan diprioritaskan dan muncul paling atas.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.pengumuman.index') }}" 
                    class="px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-gray-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-2.5 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                    Simpan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
