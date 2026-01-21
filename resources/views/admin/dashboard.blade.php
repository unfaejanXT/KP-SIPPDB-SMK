@extends('layouts.admin')

@section('header_title', 'Dashboard Overview')
@section('header_subtitle', 'Pantau statistik dan aktivitas terbaru PPDB')

@section('content')
    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Card 1: Total Pendaftar -->
            <div class="bg-blue-900 text-white p-5 rounded-xl shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-blue-200 text-sm font-medium">Total Pendaftar</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $totalPendaftar ?? 0 }}</h3>
                    <p class="text-xs text-blue-200 mt-1">Tahun ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
                </div>
                <div class="absolute right-4 top-4 p-2 bg-white/10 rounded-lg">
                    <i class="fa-solid fa-users text-white text-xl"></i>
                </div>
            </div>

             <!-- Card 2 -->
             <div class="bg-orange-50 p-5 rounded-xl border border-orange-100 shadow-sm relative">
                <p class="text-orange-600 text-sm font-medium">Menunggu Verifikasi</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ $menungguVerifikasi ?? 0 }}</h3>
                <p class="text-xs text-slate-500 mt-1">Berkas perlu ditinjau</p>
                <div class="absolute right-4 top-4 p-2 bg-orange-100 rounded-lg">
                    <i class="fa-regular fa-clock text-orange-500 text-xl"></i>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-emerald-50 p-5 rounded-xl border border-emerald-100 shadow-sm relative">
                <p class="text-emerald-600 text-sm font-medium">Terverifikasi</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ $terverifikasi ?? 0 }}</h3>
                <p class="text-xs text-slate-500 mt-1">Pendaftaran diterima</p>
                <div class="absolute right-4 top-4 p-2 bg-emerald-100 rounded-lg">
                    <i class="fa-regular fa-circle-check text-emerald-500 text-xl"></i>
                </div>
            </div>

             <!-- Card 4 -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative">
                <p class="text-slate-500 text-sm font-medium">Ditolak</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ $ditolak ?? 0 }}</h3>
                <p class="text-xs text-slate-500 mt-1">Berkas tidak lengkap</p>
                <div class="absolute right-4 top-4 p-2 bg-slate-100 rounded-lg">
                    <i class="fa-regular fa-circle-xmark text-slate-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Secondary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
             <!-- Gelombang -->
            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100 flex items-center justify-between">
                <div>
                     <p class="text-blue-600 text-xs font-semibold uppercase tracking-wider">Gelombang Aktif</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">Gelombang 1</h3>
                    <p class="text-xs text-blue-600 mt-1">Status: Dibuka</p>
                </div>
                <div class="bg-blue-200/50 p-3 rounded-lg">
                    <i class="fa-solid fa-layer-group text-blue-600 text-xl"></i>
                </div>
            </div>
             <!-- Jurusan -->
             <div class="bg-white p-5 rounded-xl border border-slate-200 flex items-center justify-between">
                <div>
                     <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Jurusan Tersedia</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $jumlahJurusan ?? 0 }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Kompetensi Keahlian</p>
                </div>
                <div class="bg-slate-50 p-3 rounded-lg">
                    <i class="fa-solid fa-shapes text-slate-500 text-xl"></i>
                </div>
            </div>
            <!-- Acceptance Rate -->
             <div class="bg-white p-5 rounded-xl border border-slate-200 flex items-center justify-between">
                <div>
                     <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Total User</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalUser ?? 0 }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Akun terdaftar</p>
                </div>
                <div class="bg-slate-50 p-3 rounded-lg">
                    <i class="fa-solid fa-users text-slate-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm col-span-2">
                <h3 class="font-semibold text-slate-800">Tren Pendaftaran</h3>
                 <p class="text-sm text-slate-500 mb-4">Grafik pendaftaran siswa harian</p>
                <div class="h-64">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
             <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h3 class="font-semibold text-slate-800">Distribusi Jurusan</h3>
                 <p class="text-sm text-slate-500 mb-4">Peminatan jurusan</p>
                <div class="h-56 flex justify-center">
                    <canvas id="donutChart"></canvas>
                </div>
                <div class="mt-4 flex justify-center space-x-4 text-xs" id="legend-container">
                    <!-- Legend will be populated by JS ideally, or static -->
                </div>
            </div>
        </div>

        <!-- Latest Registrations Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
             <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-slate-800">Pendaftaran Terbaru</h3>
                    <p class="text-sm text-slate-500">5 pendaftar terakhir yang masuk</p>
                </div>
                <button class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-medium rounded hover:bg-slate-200 transition">Lihat Semua</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                     <thead class="bg-slate-50 text-slate-500 uppercase font-medium text-xs">
                        <tr>
                            <th class="px-6 py-3">Nama Siswa</th>
                            <th class="px-6 py-3">NISN</th>
                            <th class="px-6 py-3">Jurusan</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($latestPendaftar ?? [] as $p)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold mr-3">
                                        {{ substr($p->nama_lengkap ?? 'Unknown', 0, 2) }}
                                    </div>
                                    {{ $p->nama_lengkap }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->nisn }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if(in_array(strtolower($p->status), ['menunggu', 'draft', 'menunggu_verifikasi']))
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">Menunggu</span>
                                @elseif(in_array(strtolower($p->status), ['terverifikasi', 'diterima']))
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Terverifikasi</span>
                                @elseif(strtolower($p->status) == 'ditolak')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">{{ $p->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-blue-600 hover:text-blue-800"><i class="fa-regular fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-slate-500">Belum ada pendaftaran baru.</td>
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
    // Line Chart
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    const gradient = ctxLine.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)'); // Blue 600
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            // Static labels for now
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [{
                label: 'Pendaftar',
                data: [12, 19, 3, 5, 2, 3, 10], // Static data
                borderColor: '#2563eb',
                backgroundColor: gradient,
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 3,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [2, 2], drawBorder: false },
                    ticks: { stepSize: 5 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Donut Chart
    const ctxDonut = document.getElementById('donutChart').getContext('2d');
    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['TKJ', 'AKL', 'Otomotif', 'Multimedia'],
            datasets: [{
                data: [35, 25, 20, 20], // Static data
                backgroundColor: [
                    '#1e293b', // Slate 900
                    '#3b82f6', // Blue 500
                    '#f59e0b', // Amber 500
                    '#10b981', // Emerald 500
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { display: true, position: 'bottom' }
            }
        }
    });
</script>
@endpush
