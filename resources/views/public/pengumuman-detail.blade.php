@extends('layouts.public')

@section('title', $pengumuman->judul)

@section('content')
    {{-- Hero/Title Section --}}
    <div class="relative bg-gradient-to-r from-red-600 to-red-800 pt-32 pb-16 overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center text-white/80 hover:text-white transition group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Pengumuman
                </a>
            </div>
            
            <div class="flex flex-wrap items-center gap-3 mb-6">
                <span class="bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $pengumuman->kategori ?? 'Informasi' }}
                </span>
                <span class="text-white/80 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $pengumuman->created_at->format('d F Y') }}
                </span>
            </div>

            <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-4">
                {{ $pengumuman->judul }}
            </h1>
        </div>

        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light"></div>
    </div>

    {{-- Content Section --}}
    <main class="max-w-4xl mx-auto px-4 py-12">
        <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 md:p-12 mb-12">
            <div class="prose prose-slate prose-lg max-w-none prose-headings:text-slate-900 prose-a:text-red-600 hover:prose-a:text-red-700">
                {!! $pengumuman->konten !!}
            </div>
        </article>

        {{-- Share or Other Actions could go here --}}
    </main>

    {{-- FOOTER --}}
    @include('public.footer')
@endsection
