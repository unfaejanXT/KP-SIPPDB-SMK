@extends('layouts.student')

@section('title', 'Daftar Pengumuman')
@section('header_title', 'Pengumuman')
@section('header_subtitle', 'Informasi dan pengumuman terbaru seputar PPDB')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Search Section
    <form action="{{ route('dashboard.pengumuman') }}" method="GET" class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" name="q" value="{{ request('q') }}"
            class="block w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm shadow-sm placeholder-slate-400"
            placeholder="Cari pengumuman...">
    </form>
    --}}

    {{-- Announcement List --}}
    <div class="space-y-6">
        @forelse($pengumuman as $item)
            <div
                class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition duration-300 {{ $item->is_pinned ? 'ring-1 ring-indigo-500 bg-indigo-50/10' : '' }}">
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <span class="bg-indigo-50 text-indigo-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $item->kategori ?? 'Informasi' }}</span>
                    @if($item->is_pinned)
                         <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Tersemat</span>
                    @endif

                    <div class="flex items-center text-slate-400 text-xs ml-auto">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $item->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
                
                <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $item->judul }}</h3>
                
                <div class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-3">
                    {!! Str::limit(strip_tags($item->konten), 150) !!}
                </div>
                
                <a href="{{ route('dashboard.pengumuman.show', $item->slug) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                    Baca selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        @empty
            <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-slate-800">Belum ada pengumuman</h4>
                <p class="text-slate-500 text-sm mt-1">Kembali lagi nanti untuk melihat informasi terbaru.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="text-center pt-4">
        {{ $pengumuman->links() }}
    </div>

</div>
@endsection
