@extends('layouts.admin')

@section('header_title', 'Dashboard Overview')
@section('header_subtitle', 'Pantau statistik dan aktivitas terbaru PPDB')

@section('content')
    <div class="space-y-6">
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Card 1: Total Pendaftar -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="text-blue-200 text-sm font-medium tracking-wide">Total Pendaftar</p>
                    <h3 class="text-4xl font-extrabold mt-2 group-hover:scale-105 transition-transform">{{ $totalPendaftar ?? 0 }}</h3>
                    <p class="text-xs text-blue-100/80 mt-2">
                        @if($activeGelombang)
                            Tahun Ajaran {{ $activeGelombang->tahun_ajaran }}
                        @else
                            Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
                        @endif
                    </p>
                </div>
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity transform group-hover:rotate-12">
                    <i class="fa-solid fa-users text-8xl text-white"></i>
                </div>
            </div>

            <!-- Card 2: Menunggu -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative group">
                <p class="text-orange-500 text-sm font-bold uppercase tracking-wider">Menunggu Verifikasi</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $menungguVerifikasi ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Berkas perlu ditinjau</p>
                <div class="absolute right-4 top-4 p-3 bg-orange-50 rounded-xl group-hover:bg-orange-100 transition-colors">
                    <i class="fa-regular fa-clock text-orange-500 text-xl"></i>
                </div>
            </div>

            <!-- Card 3: Terverifikasi -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative group">
                <p class="text-emerald-500 text-sm font-bold uppercase tracking-wider">Terverifikasi</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $terverifikasi ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Pendaftaran diterima</p>
                <div class="absolute right-4 top-4 p-3 bg-emerald-50 rounded-xl group-hover:bg-emerald-100 transition-colors">
                    <i class="fa-regular fa-circle-check text-emerald-500 text-xl"></i>
                </div>
            </div>

            <!-- Card 4: Ditolak -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative group">
                <p class="text-red-500 text-sm font-bold uppercase tracking-wider">Ditolak</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $ditolak ?? 0 }}</h3>
                <p class="text-xs text-slate-400 mt-2">Berkas tidak lengkap</p>
                <div class="absolute right-4 top-4 p-3 bg-red-50 rounded-xl group-hover:bg-red-100 transition-colors">
                    <i class="fa-regular fa-circle-xmark text-red-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Secondary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Gelombang -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-blue-600 text-xs font-bold uppercase tracking-wider">Gelombang Aktif</p>
                    @if($activeGelombang)
                        <h3 class="text-xl font-bold text-slate-800 mt-1">{{ $activeGelombang->nama }}</h3>
                        <p class="text-xs text-emerald-600 mt-1 font-medium flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Dibuka s/d {{ \Carbon\Carbon::parse($activeGelombang->tanggal_selesai)->format('d M Y') }}
                        </p>
                    @else
                        <h3 class="text-xl font-bold text-slate-800 mt-1">Tidak Ada</h3>
                        <p class="text-xs text-slate-400 mt-1">Pendaftaran ditutup</p>
                    @endif
                </div>
                <div class="bg-blue-50 p-3 rounded-xl group-hover:bg-blue-100 transition-colors">
                    <i class="fa-solid fa-calendar-day text-blue-600 text-xl"></i>
                </div>
            </div>

            <!-- Jurusan -->
             <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between group">
                <div>
                     <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Jurusan Tersedia</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $jumlahJurusan ?? 0 }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Kompetensi Keahlian</p>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl group-hover:bg-slate-100 transition-colors">
                    <i class="fa-solid fa-shapes text-slate-500 text-xl"></i>
                </div>
            </div>

            <!-- Total Users -->
             <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between group">
                <div>
                     <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total User</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalUser ?? 0 }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Akun terdaftar</p>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl group-hover:bg-slate-100 transition-colors">
                    <i class="fa-solid fa-users text-slate-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">Tren Pendaftaran</h3>
                        <p class="text-sm text-slate-500">Aktivitas pendaftaran 7 hari terakhir</p>
                    </div>
                </div>
                <div class="h-72 w-full">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
             <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col">
                <h3 class="font-bold text-slate-800 text-lg">Minat Jurusan</h3>
                <p class="text-sm text-slate-500 mb-6">Distribusi pilihan pendaftar</p>
                <div class="flex-grow flex items-center justify-center relative">
                     <div class="h-56 w-56 relative z-10">
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Registrations Table -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
             <div class="p-4 md:p-6 border-b border-slate-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">Pendaftaran Terbaru</h3>
                    <p class="text-sm text-slate-500">5 pendaftar terakhir yang masuk</p>
                </div>
                <a href="{{ route('admin.verifikasi.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-white border border-slate-200 text-slate-600 text-xs font-semibold rounded-lg hover:bg-slate-50 hover:text-blue-600 transition shadow-sm">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                     <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">NISN</th>
                            <th class="px-6 py-4">Jurusan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($latestPendaftar ?? [] as $p)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600 flex items-center justify-center text-xs font-bold shadow-sm">
                                        {{ substr($p->nama_lengkap ?? 'Un', 0, 2) }}
                                    </div>
                                    <span class="font-semibold">{{ $p->nama_lengkap }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->nisn }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $p->jurusan->nama_jurusan ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $status = strtolower($p->status);
                                @endphp
                                @if(in_array($status, ['menunggu', 'draft', 'menunggu_verifikasi', 'submitted', 'pending']))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @elseif(in_array($status, ['terverifikasi', 'diterima']))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <i class="fa-solid fa-check mr-1.5 text-[10px]"></i>
                                        Terverifikasi
                                    </span>
                                @elseif($status == 'ditolak')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                        <i class="fa-solid fa-xmark mr-1.5 text-[10px]"></i>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">{{ $p->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs">
                                {{ $p->created_at ? $p->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.verifikasi.show', $p->id) }}" class="p-2 bg-white border border-slate-200 text-slate-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-slate-50 p-4 rounded-full mb-3">
                                        <i class="fa-solid fa-inbox text-3xl text-slate-300"></i>
                                    </div>
                                    <p>Belum ada pendaftaran baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Constants from Backend
    const chartLabels = {!! json_encode($formattedLabels ?? []) !!};
    const chartData = {!! json_encode($chartValues ?? []) !!};
    const jurusanLabels = {!! json_encode($jurusanLabels ?? []) !!};
    const jurusanData = {!! json_encode($jurusanValues ?? []) !!};

    // Common Chart Options
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b';

    // Line Chart
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    const gradient = ctxLine.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.1)'); // Blue 600
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Pendaftar',
                data: chartData,
                borderColor: '#2563eb', // Blue 600
                backgroundColor: gradient,
                borderWidth: 2,
                tension: 0.3, 
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563eb',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#2563eb',
                pointHoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 13 },
                    bodyFont: { size: 14, weight: 'bold' },
                    displayColors: false,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [4, 4], color: '#e2e8f0', drawBorder: false },
                    ticks: { stepSize: 1, font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });

    // Donut Chart
    const ctxDonut = document.getElementById('donutChart').getContext('2d');
    
    // Palette
    const palette = [
        '#3b82f6', // Blue 500
        '#10b981', // Emerald 500
        '#f59e0b', // Amber 500
        '#6366f1', // Indigo 500
        '#ec4899', // Pink 500
        '#8b5cf6', // Violet 500
    ];

    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: jurusanLabels,
            datasets: [{
                data: jurusanData,
                backgroundColor: palette,
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { 
                    display: true, 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: { size: 11 }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.parsed;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100) + '%';
                            return label + ': ' + value + ' (' + percentage + ')';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
