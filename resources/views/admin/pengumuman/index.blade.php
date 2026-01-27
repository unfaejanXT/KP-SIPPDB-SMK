@extends('layouts.admin')

@section('title', 'Kelola Pengumuman - PPDB SMK SBI')

@section('header_title', 'Kelola Pengumuman')
@section('header_subtitle', 'Publikasikan informasi dan pengumuman PPDB')

@section('content')
<div x-data="{ showDeleteModal: false, deleteUrl: '' }">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-bullhorn text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pengumuman->count() }}</h3>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Pengumuman</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                <i class="fa-regular fa-eye text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pengumuman->where('status', 'published')->count() }}</h3>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Dipublikasikan</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-orange-600">
                <i class="fa-solid fa-thumbtack text-xl transform rotate-45"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pengumuman->where('is_pinned', true)->count() }}</h3>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Disematkan</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-teal-50 rounded-lg flex items-center justify-center text-teal-600">
                <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pengumuman->sum('views') }}</h3>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Views</p>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-slate-800">Daftar Pengumuman</h3>
        <a href="{{ route('admin.pengumuman.create') }}" class="bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center shadow-sm transition-all">
            <i class="fa-solid fa-plus mr-2"></i> Buat Pengumuman
        </a>
    </div>

    <div class="space-y-4">
        @forelse($pengumuman as $item)
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm relative group hover:border-blue-300 transition-all">
            <div class="flex justify-between items-start">
                <div class="w-full">
                    <div class="flex items-center gap-2 mb-1">
                        @if($item->is_pinned)
                        <i class="fa-solid fa-thumbtack text-blue-500 text-xs transform rotate-45"></i>
                        @endif
                        <h4 class="text-base font-semibold text-slate-800">{{ $item->judul }}</h4>
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $item->kategori == 'Informasi' ? 'bg-blue-50 text-blue-600' : ($item->kategori == 'Hasil Seleksi' ? 'bg-green-50 text-green-600' : ($item->kategori == 'Jadwal' ? 'bg-orange-50 text-orange-600' : 'bg-gray-50 text-gray-600')) }} border border-current opacity-80">
                            {{ $item->kategori }}
                        </span>
                        @if($item->status == 'draft')
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-gray-50 text-gray-500 border border-gray-200">
                            Draft
                        </span>
                        @else
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-green-50 text-green-600 border border-green-200">
                            Dipublikasikan
                        </span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-500 mt-1 mb-3 line-clamp-2">{{ Str::limit(strip_tags($item->konten), 200) }}</p>

                    <div class="flex items-center gap-4 text-xs text-slate-400">
                        <span class="flex items-center"><i class="fa-regular fa-calendar mr-1.5"></i> {{ $item->created_at->translatedFormat('d F Y') }}</span>
                        <span class="flex items-center"><i class="fa-regular fa-eye mr-1.5"></i> {{ $item->views }} views</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    @if($item->status == 'draft')
                    <form action="{{ route('admin.pengumuman.toggle-status', $item) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-md text-xs font-medium transition-colors">
                            Publikasikan
                        </button>
                    </form>
                    @else
                    <form action="{{ route('admin.pengumuman.toggle-status', $item) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-slate-500 hover:text-slate-700 font-medium text-xs transition-colors">
                            Jadikan Draft
                        </button>
                    </form>
                    @endif
                    
                    <div class="relative group/menu flex items-center">
                        <a href="{{ route('admin.pengumuman.edit', $item) }}" class="text-slate-400 hover:text-blue-600 p-2 rounded-lg hover:bg-blue-50 transition-colors" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button @click="showDeleteModal = true; deleteUrl = '{{ route('admin.pengumuman.destroy', $item) }}'" class="text-slate-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-12 rounded-xl border border-dashed border-gray-300 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mb-4">
                <i class="fa-solid fa-bullhorn text-2xl"></i>
            </div>
            <h4 class="text-lg font-semibold text-slate-800">Belum ada pengumuman</h4>
            <p class="text-slate-500 text-sm max-w-xs mt-1">Mulai buat pengumuman pertama Anda untuk memberikan informasi kepada calon siswa.</p>
            <a href="{{ route('admin.pengumuman.create') }}" class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                Buat Sekarang
            </a>
        </div>
        @endforelse
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 overflow-hidden transform transition-all"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
             
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-600">
                    <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Hapus Pengumuman?</h3>
                <p class="text-slate-500 text-sm mb-6">Apakah Anda yakin ingin menghapus pengumuman ini? Tindakan ini tidak dapat dibatalkan.</p>
                
                <div class="flex items-center justify-center gap-3">
                    <button @click="showDeleteModal = false" class="px-5 py-2.5 rounded-lg border border-gray-300 text-slate-600 hover:bg-gray-50 font-medium text-sm transition-colors">
                        Batal
                    </button>
                    <form :action="deleteUrl" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2.5 rounded-lg bg-red-600 text-white hover:bg-red-700 font-medium text-sm transition-colors shadow-sm shadow-red-200">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
