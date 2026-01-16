<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Sandbox') }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ $hariIni->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Siswa Mendaftar -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-2xl border border-gray-100">
                    <div class="p-6 flex items-center">
                        <div class="p-4 rounded-xl bg-blue-50 text-blue-600 mr-4">
                            <i class="bi bi-people-fill text-3xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalPendaftar }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Total Data Terverifikasi -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-2xl border border-gray-100">
                    <div class="p-6 flex items-center">
                        <div class="p-4 rounded-xl bg-green-50 text-green-600 mr-4">
                            <i class="bi bi-patch-check-fill text-3xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Terverifikasi</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalDiverifikasi }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Total Data Belum Diverifikasi -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-2xl border border-gray-100">
                    <div class="p-6 flex items-center">
                        <div class="p-4 rounded-xl bg-yellow-50 text-yellow-600 mr-4">
                            <i class="bi bi-hourglass-split text-3xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Belum Verifikasi</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalBelumDiverifikasi }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column (Main Content) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Periode Info Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Informasi Periode Pendaftaran</h3>
                                <p class="text-sm text-gray-500">Status dan jadwal gelombang saat ini</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusPendaftaran == 'Aktif' || $statusPendaftaran == 'Buka' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $statusPendaftaran }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Gelombang</p>
                                <p class="text-lg font-bold text-gray-700">{{ $gelombang }}</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Periode</p>
                                <p class="text-lg font-bold text-gray-700">{{ $tanggalMulai }} - {{ $tanggalSelesai }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                             <a href="{{ route('sandbox.gelombangppdb') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="bi bi-gear-fill mr-2"></i> Kelola Gelombang
                            </a>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Chart: Pendaftar -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h4 class="text-base font-bold text-gray-800 mb-4">Statistik Pendaftar</h4>
                            <div class="flex flex-col items-center justify-center p-4">
                                <span class="text-4xl font-extrabold text-indigo-600 mb-2">250</span>
                                <span class="text-sm text-gray-500 text-center">Siswa mendaftar pada gelombang ini</span>
                            </div>
                        </div>

                        <!-- Chart: Gender -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h4 class="text-base font-bold text-gray-800 mb-4">Demografi Gender</h4>
                            <div x-data="{
                                genderData: [150, 100], 
                                labels: ['Laki-laki', 'Perempuan']
                            }" class="relative h-48 w-full flex justify-center">
                                <canvas id="genderChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Registrations Table -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800">Pendaftar Terbaru</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-50 text-gray-500 uppercase font-medium">
                                    <tr>
                                        <th class="px-6 py-4">No</th>
                                        <th class="px-6 py-4">Nama Lengkap</th>
                                        <th class="px-6 py-4">Jurusan</th>
                                        <th class="px-6 py-4">Status Verifikasi</th>
                                        <th class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">1</td>
                                        <td class="px-6 py-4">Ahmad Rizal</td>
                                        <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">TJKT</span></td>
                                        <td class="px-6 py-4 text-green-600"><i class="bi bi-check-circle-fill mr-1"></i> Terverifikasi</td>
                                        <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Diterima</span></td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">2</td>
                                        <td class="px-6 py-4">Siti Aminah</td>
                                        <td class="px-6 py-4"><span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">AKL</span></td>
                                        <td class="px-6 py-4 text-yellow-600"><i class="bi bi-clock-fill mr-1"></i> Pending</td>
                                        <td class="px-6 py-4"><span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">Menunggu</span></td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900">3</td>
                                        <td class="px-6 py-4">Joko Santoso</td>
                                        <td class="px-6 py-4"><span class="bg-pink-100 text-pink-800 text-xs font-semibold px-2.5 py-0.5 rounded">DKV</span></td>
                                        <td class="px-6 py-4 text-green-600"><i class="bi bi-check-circle-fill mr-1"></i> Terverifikasi</td>
                                        <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Diterima</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                             <a href="{{ route('sandbox.siswa') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">Lihat Semua Pendaftar &rarr;</a>
                         </div>
                    </div>
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="space-y-8">
                     <!-- Profile Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <i class="bi bi-person-badge text-9xl text-indigo-500"></i>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Profil Admin</h3>
                            <div class="flex items-center mb-6">
                                <div class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl font-bold border-4 border-white shadow-sm">
                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">{{ Auth::user()->name ?? 'Administrator' }}</h4>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email ?? 'admin@sekolah.sch.id' }}</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Role</span>
                                    <span class="font-medium text-gray-800">Administrator</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Contact</span>
                                    <span class="font-medium text-gray-800">{{ Auth::user()->nohp }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="space-y-4">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-exclamation-triangle-fill text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Tenggat Waktu Verifikasi</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Segera selesaikan verifikasi berkas sebelum <strong>2025-05-01</strong>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-info-circle-fill text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Gelombang Berikutnya</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>Gelombang II akan dibuka pada <strong>2025-06-01</strong>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ChartJS and Alpine Logic -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('genderChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [150, 100],
                        backgroundColor: [
                            '#4F46E5', // Indigo 600
                            '#EC4899', // Pink 500
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>