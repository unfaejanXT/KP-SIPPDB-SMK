@extends('layouts.public')

@section('title', 'Jadwal PPDB')
@section('hideContact', true)

@section('content')
    {{-- HEADER SECTION --}}
    <header class="relative bg-gradient-to-r from-red-600 to-red-800 pt-16 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur-sm border border-white/30 mb-4">
                Jadwal PPDB
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Jadwal Pendaftaran PPDB</h1>
            <p class="text-white/90 text-lg">Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>

        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light">
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 -mt-20 relative z-20 pb-20">

        {{-- JADWAL CARDS --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 mb-12">
            <div class="text-center mb-10">
                <span class="text-xs font-bold text-red-600 uppercase tracking-wider bg-red-50 px-2 py-1 rounded">Jadwal
                    PPDB</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-2">Jadwal Pendaftaran</h2>
                <p class="text-gray-500 mt-1 text-sm">Pilih gelombang pendaftaran yang sesuai dengan waktu Anda. Daftar
                    lebih awal untuk mendapatkan keuntungan lebih!</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse($gelombangs as $wave)
                    @php
                        // Status logic
                        $now = now();
                        $start = \Carbon\Carbon::parse($wave->tanggal_mulai);
                        $end = \Carbon\Carbon::parse($wave->tanggal_selesai);
                        
                        $isOpen = $wave->is_active && $now->between($start, $end);
                        $isUpcoming = $now->lt($start);
                        $isClosed = $now->gt($end) || !$wave->is_active;

                        if ($isOpen) {
                            $status = 'Dibuka';
                            $statusColor = 'bg-green-500 text-white';
                            $borderColor = 'border-red-500 ring-4 ring-red-500/10';
                            $isRec = true;
                        } elseif ($isUpcoming) {
                            $status = 'Segera';
                            $statusColor = 'text-gray-500 bg-gray-100 border border-gray-200';
                            $borderColor = 'border-gray-200';
                            $isRec = false;
                        } else {
                            $status = 'Ditutup';
                            $statusColor = 'text-red-500 bg-red-50 border border-red-200';
                            $borderColor = 'border-gray-200 opacity-75';
                            $isRec = false;
                        }
                    @endphp

                    <div class="relative bg-white rounded-xl p-6 flex flex-col h-full border {{ $borderColor }}">

                        @if($isRec)
                        <div
                            class="absolute -top-3 left-1/2 -translate-x-1/2 bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Rekomendasi
                        </div>
                        @endif

                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-gray-800 text-lg">{{ $wave->nama }}</h3>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $statusColor }}">
                                {{ $status }}
                            </span>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>
                                    {{ $start->translatedFormat('d F') }} - {{ $end->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            {{-- Quota Simulation (Using static logic since DB might not have enrollment count yet, or just hide) --}}
                            {{-- Ideally we would count registered students for this wave --}}
                        </div>

                        <div class="border-t border-gray-100 pt-4 mt-auto">
                            <p class="text-xs font-semibold text-gray-500 mb-3">Keuntungan:</p>
                            <ul class="space-y-2">
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Prioritas Seleksi
                                </li>
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Seragam Gratis (Syarat & Ketentuan)
                                </li>
                            </ul>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">
                        Belum ada jadwal gelombang yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- TIMELINE SECTION --}}
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <span
                    class="text-xs font-bold text-red-600 uppercase tracking-wider bg-red-50 px-2 py-1 rounded">Timeline</span>
                <h2 class="text-2xl font-bold text-gray-800 mt-2">Tanggal Penting</h2>
                <p class="text-gray-500 text-sm">Catat tanggal-tanggal penting berikut agar tidak terlewat</p>
            </div>

            <div class="space-y-3">
                {{-- Dynamic Timeline from Gelombangs --}}
                @foreach($gelombangs as $wave)
                    <div class="bg-white rounded-lg p-4 flex items-center gap-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">
                                {{ \Carbon\Carbon::parse($wave->tanggal_mulai)->translatedFormat('d F Y') }}
                            </h4>
                            <p class="text-gray-500 text-xs">Pembukaan Pendaftaran {{ $wave->nama }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4 flex items-center gap-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">
                                {{ \Carbon\Carbon::parse($wave->tanggal_selesai)->translatedFormat('d F Y') }}
                            </h4>
                            <p class="text-gray-500 text-xs">Penutupan Pendaftaran {{ $wave->nama }}</p>
                        </div>
                    </div>
                @endforeach
                
                {{-- Manual entries for other events if needed --}}
                <div class="bg-white rounded-lg p-4 flex items-center gap-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                     <div class="flex-shrink-0 w-10 h-10 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-sm">Juli {{ date('Y') }}</h4>
                        <p class="text-gray-500 text-xs">Masa Pengenalan Lingkungan Sekolah (MPLS)</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="bg-amber-50 border-y border-amber-100 py-6">
        <div class="max-w-7xl mx-auto px-4 flex items-start gap-3">
            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            <div>
                <h4 class="font-bold text-gray-800 text-sm">Catatan Penting</h4>
                <p class="text-gray-600 text-xs mt-1 leading-relaxed max-w-2xl">
                    Jadwal dapat berubah sewaktu-waktu sesuai dengan kebijakan sekolah. Silakan pantau website ini
                    secara berkala atau hubungi panitia PPDB untuk informasi terbaru.
                </p>
            </div>
        </div>
    </div>

    {{-- Footer is already included in layout --}}
@endsection
