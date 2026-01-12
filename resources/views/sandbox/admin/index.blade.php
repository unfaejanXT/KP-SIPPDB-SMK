<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-6 flex justify-around space-evenly">
                    <!-- Total Siswa Mendaftar -->
                    <div class="bg-white shadow rounded-lg p-4 flex items-center">
                        <div class="bg-blue-500 rounded-lg p-3 mr-4">
                            <i class="bi bi-person-fill text-white text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1">Total Siswa Mendaftar</h3>
                            <span class="text-2xl font-bold text-gray-900">{{$totalPendaftar}}</span>
                        </div>
                    </div>

                    <!-- Total Data Terverifikasi -->
                    <div class="bg-white shadow rounded-lg p-4 flex items-center">
                        <div class="bg-green-500 rounded-lg p-3 mr-4">
                            <i class="bi bi-person-fill-check text-white text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1">Total Data Terverifikasi</h3>
                            <span class="text-2xl font-bold text-gray-900">{{$totalDiverifikasi}}</span>
                        </div>
                    </div>

                    <!-- Total Data Belum Diverifikasi -->

                    <div class="bg-white shadow rounded-lg p-4 flex items-center">
                        <div class="bg-yellow-500 rounded-lg p-3 mr-4">
                            <i class="bi bi-person-fill-exclamation text-white text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1">Total Data Belum Diverifikasi</h3>
                            <span class="text-2xl font-bold text-gray-900">{{$totalBelumDiverifikasi}}</span>
                        </div>
                    </div>
                </div>

                <!-- Information Details -->
                <div class="bg-blue-500 text-white p-4 m-8 rounded-t-lg ">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5.882V19.24a1.76 1.76 0 01-1.76 1.76H5.5a1.76 1.76 0 01-1.76-1.76V5.5A1.76 1.76 0 015.5 3.74h9.92a1.76 1.76 0 011.76 1.76v.042Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0z" />
                        </svg>
                        <span class="ml-2 font-bold text-lg">Mahasiswa</span>
                    </div>

                </div>
                <div class="bg-white px-4  mx-8  rounded-b-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="font-bold">NPM</div>
                        <div>5520121011</div>
                        <div class="font-bold">Nama</div>
                        <div>Janwar Ksatria Pamungkas</div>
                        <div class="font-bold">Dosen Wali</div>
                        <div>ABCD</div>
                    </div>
                </div>


                <!-- Tampilan Gelombang Pendaftaran -->

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Informasi Periode Pendaftaran
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Waktu Hari Ini: {{ $hariIni->format('d M Y') }}</h5>
                                <p class="card-text">
                                    <strong>Status Pendaftaran:</strong> {{ $statusPendaftaran }}<br>
                                    <strong>Gelombang Pendaftaran:</strong> {{ $gelombang }}<br>
                                    <strong>Periode Pendaftaran:</strong> {{ $tanggalMulai }} sampai
                                    {{ $tanggalSelesai }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <!-- Tombol Kelola Gelombang Pendaftaran -->
                                <a href="{{ route('sandbox.gelombangppdb') }}" class="btn btn-primary">Kelola Gelombang
                                    Pendaftaran</a>
                                <!-- Petunjuk -->
                                <small class="text-muted">
                                    Klik tombol di atas untuk mengelola periode gelombang pendaftaran, seperti mengubah
                                    tanggal mulai, tanggal selesai, dan status gelombang.
                                </small>
                            </div>


                            <!-- Demo tampilan -->

                            <div class="container mx-auto p-4">

                                <!-- Row untuk Gelombang Pendaftaran -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Card: Jumlah Pendaftar di Gelombang Saat Ini -->
                                    <div class="card bg-white shadow-lg rounded-lg p-4">
                                        <div class="card-header text-xl font-semibold">
                                            Jumlah Pendaftar di Gelombang Saat Ini
                                        </div>
                                        <div class="card-body">
                                            <h5 class="text-3xl font-bold text-center">250</h5>
                                            <p class="text-center text-gray-600">Jumlah calon siswa yang telah mendaftar
                                                pada gelombang pendaftaran saat ini.</p>
                                        </div>
                                    </div>

                                    <!-- Card: Pendaftar Berdasarkan Gender -->
                                    <div class="card bg-white shadow-lg rounded-lg p-4">
                                        <div class="card-header text-xl font-semibold">
                                            Pendaftar Berdasarkan Gender
                                        </div>
                                        <div class="card-body">
                                            <div x-data="{
                    genderData: [150, 100],  <!-- Data statis: 150 Laki-laki, 100 Perempuan -->
                    labels: ['Laki-laki', 'Perempuan']
                }">
                                                <!-- Pie chart menggunakan Alpine.js dan Chart.js -->
                                                <canvas id="genderChart" width="400" height="400"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Peringatan dan Notifikasi -->
                                <div class="mt-6">
                                    <div class="card bg-yellow-100 border-l-4 border-yellow-600 p-4 mb-4">
                                        <div class="font-semibold text-yellow-800">
                                            Peringatan!
                                        </div>
                                        <div class="text-yellow-800">
                                            Tenggat waktu verifikasi berkas untuk gelombang pendaftaran saat ini adalah
                                            pada 2025-05-01. Harap segera menyelesaikan verifikasi berkas.
                                        </div>
                                    </div>

                                    <div class="card bg-blue-100 border-l-4 border-blue-600 p-4">
                                        <div class="font-semibold text-blue-800">
                                            Informasi!
                                        </div>
                                        <div class="text-blue-800">
                                            Gelombang pendaftaran kedua akan dibuka mulai 2025-06-01. Pastikan semua
                                            data sudah terupdate.
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel Detail Pendaftar -->
                                <div class="mt-6">
                                    <div class="card bg-white shadow-lg rounded-lg p-4">
                                        <div class="card-header text-xl font-semibold">
                                            Tabel Detail Pendaftar
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped w-full">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Jurusan</th>
                                                        <th>Status Verifikasi</th>
                                                        <th>Status Pendaftaran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Ahmad Rizal</td>
                                                        <td>Teknik Komputer</td>
                                                        <td>Verifikasi</td>
                                                        <td>Diterima</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Siti Aminah</td>
                                                        <td>Akuntansi</td>
                                                        <td>Belum Verifikasi</td>
                                                        <td>Menunggu</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Joko Santoso</td>
                                                        <td>Multimedia</td>
                                                        <td>Verifikasi</td>
                                                        <td>Diterima</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- Tambahkan Alpine.js dan Chart.js -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

                            <script>
                                // Inisialisasi Chart.js setelah Alpine.js selesai memuat
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('genderChartData', () => ({
                                        init() {
                                            var ctx = document.getElementById('genderChart').getContext('2d');
                                            var genderChart = new Chart(ctx, {
                                                type: 'pie',
                                                data: {
                                                    labels: this.labels,
                                                    datasets: [{
                                                        label: 'Pendaftar Berdasarkan Gender',
                                                        data: this.genderData,
                                                        backgroundColor: ['#36A2EB', '#FF6384'],
                                                        borderColor: ['#fff', '#fff'],
                                                        borderWidth: 1
                                                    }]
                                                }
                                            });
                                        }
                                    }));
                                });
                            </script>

                            <div class="p-6 text-gray-900 text-center">
                                {{ __("Selamat Datang, ") . Auth::user()->nohp }}
                            </div>
                        </div>
                    </div>
                </div>
</x-app-layout>