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

                            <option value="Jadwal" {{ old('kategori') == 'Jadwal' ? 'selected' : '' }}>Jadwal</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div x-data="{ 
                            open: false, 
                            selected: '{{ old('status', 'published') }}',
                            get label() { return this.selected === 'published' ? 'Langsung Publikasikan' : 'Simpan sebagai Draft' },
                            get icon() { return this.selected === 'published' ? 'fa-solid fa-paper-plane' : 'fa-solid fa-pen-ruler' },
                            get color() { return this.selected === 'published' ? 'text-green-600' : 'text-slate-500' }
                        }" class="relative">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                        
                        <!-- Hidden Input -->
                        <input type="hidden" name="status" x-model="selected">
                        
                        <!-- Trigger -->
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="w-full px-4 py-3 text-left rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none bg-white flex items-center justify-between group hover:border-blue-300">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-gray-50 group-hover:bg-blue-50 transition-colors">
                                    <i :class="[icon, color]" class="text-sm"></i>
                                </div>
                                <span class="text-slate-700 font-medium" x-text="label"></span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 -translate-y-2"
                            x-transition:enter-end="transform opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="transform opacity-100 translate-y-0"
                            x-transition:leave-end="transform opacity-0 -translate-y-2"
                            class="absolute z-20 w-full mt-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden"
                            style="display: none;">
                            
                            <div class="p-1.5 space-y-1">
                                <button type="button" @click="selected = 'published'; open = false"
                                    class="w-full px-3 py-2.5 text-left rounded-lg hover:bg-blue-50 flex items-center gap-3 transition-colors group/item"
                                    :class="selected === 'published' ? 'bg-blue-50' : ''">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-green-50 text-green-600 group-hover/item:bg-white transition-colors">
                                        <i class="fa-solid fa-paper-plane text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-slate-700 font-medium text-sm">Langsung Publikasikan</p>
                                        <p class="text-slate-400 text-xs">Pengumuman akan langsung aktif dan terlihat</p>
                                    </div>
                                    <i x-show="selected === 'published'" class="fa-solid fa-check text-blue-600 text-sm"></i>
                                </button>

                                <button type="button" @click="selected = 'draft'; open = false"
                                    class="w-full px-3 py-2.5 text-left rounded-lg hover:bg-blue-50 flex items-center gap-3 transition-colors group/item"
                                    :class="selected === 'draft' ? 'bg-blue-50' : ''">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 text-slate-500 group-hover/item:bg-white transition-colors">
                                        <i class="fa-solid fa-pen-ruler text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-slate-700 font-medium text-sm">Simpan sebagai Draft</p>
                                        <p class="text-slate-400 text-xs">Simpan dulu, publikasikan nanti</p>
                                    </div>
                                    <i x-show="selected === 'draft'" class="fa-solid fa-check text-blue-600 text-sm"></i>
                                </button>
                            </div>
                        </div>
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
                        <label for="is_pinned" class="font-semibold text-blue-900"><i class="fa-solid fa-thumbtack mr-2"></i>Sematkan Pengumuman</label>
                        <p class="text-blue-700">Pengumuman ini akan diprioritaskan dan muncul paling atas.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.pengumuman.index') }}" 
                    class="px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-gray-100 transition-colors">
                    <i class="fa-solid fa-arrow-left mr-2"></i>Batal
                </a>
                <button type="submit" 
                    class="px-8 py-2.5 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Simpan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
