@extends('layouts.student')

@section('title', 'Pengumuman - PPDB SMK SBI')
@section('header_title', 'Pengumuman')
@section('header_subtitle', 'Informasi terbaru seputar PPDB SMK SBI')

@section('content')
@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    @if($pengumuman->where('is_pinned', true)->count() > 0)
    <section>
        <div class="flex items-center gap-2 mb-4 text-slate-800">
            <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
            <h3 class="font-bold text-base">Pengumuman Tersemat</h3>
        </div>

        @foreach($pengumuman->where('is_pinned', true) as $item)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 mb-4 hover:shadow-md transition-shadow relative group">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-wide border border-indigo-100">{{ $item->kategori }}</span>
                        @if($item->created_at->diffInDays() < 7)
                        <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wide border border-blue-100">Baru</span>
                        @endif
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">{{ $item->judul }}</h4>
                    <div class="flex items-center text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $item->created_at->translatedFormat('d F Y') }}
                    </div>
                    <div class="text-sm text-slate-600 leading-relaxed prose prose-slate max-w-none">
                        {!! nl2br(e($item->konten)) !!}
                    </div>
                </div>
            </div>
            <div class="absolute left-0 top-4 bottom-4 w-1 bg-indigo-600 rounded-r-full"></div>
        </div>
        @endforeach
    </section>
    @endif

    <section>
        <div class="flex items-center gap-2 mb-4 text-slate-800 {{ $pengumuman->where('is_pinned', true)->count() > 0 ? 'mt-8' : '' }}">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                </path>
            </svg>
            <h3 class="font-bold text-base">Semua Pengumuman</h3>
        </div>

        @forelse($pengumuman->where('is_pinned', false) as $item)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 mb-4 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 rounded-full bg-slate-50 text-slate-600 text-[10px] font-bold uppercase tracking-wide border border-slate-100">{{ $item->kategori }}</span>
                        @if($item->created_at->diffInDays() < 7)
                        <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wide border border-blue-100">Baru</span>
                        @endif
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">{{ $item->judul }}</h4>
                    <div class="flex items-center text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $item->created_at->translatedFormat('d F Y') }}
                    </div>
                    <div class="text-sm text-slate-600 leading-relaxed">
                        {!! nl2br(e($item->konten)) !!}
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-bold text-slate-800">Belum ada pengumuman</h4>
            <p class="text-slate-500 text-sm">Kembali lagi nanti untuk melihat informasi terbaru.</p>
        </div>
        @endforelse
    </section>

    <div class="h-8"></div>
</div>
@endsection
