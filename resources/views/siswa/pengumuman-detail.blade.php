@extends('layouts.student')

@section('title', $pengumuman->judul)
@section('header_title', 'Detail Pengumuman')
@section('header_subtitle')
    <a href="{{ route('dashboard.pengumuman') }}" class="hover:underline">Pengumuman</a> / {{ \Illuminate\Support\Str::limit($pengumuman->judul, 30) }}
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Header --}}
        <div class="bg-slate-50 border-b border-slate-200 px-8 py-6">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <a href="{{ route('dashboard.pengumuman') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
            
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4 leading-tight">
                {{ $pengumuman->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-600 font-bold uppercase tracking-wide text-xs">
                    {{ $pengumuman->kategori ?? 'Informasi' }}
                </span>
                
                @if($pengumuman->is_pinned)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 font-bold uppercase tracking-wide text-xs">
                        Tersemat
                    </span>
                @endif
                
                <div class="flex items-center text-slate-500">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $pengumuman->created_at->translatedFormat('d F Y, H:i') }} WIB
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-8 md:p-10">
            <div class="prose prose-slate prose-lg max-w-none prose-headings:text-slate-900 prose-a:text-indigo-600 hover:prose-a:text-indigo-700">
                {!! $pengumuman->konten !!}
            </div>
        </div>
        
        {{-- Footer/Actions if needed --}}
        <div class="bg-slate-50 border-t border-slate-100 px-8 py-4 flex justify-end">
             {{-- Maybe share buttons or print? --}}
        </div>

    </div>
</div>
@endsection
