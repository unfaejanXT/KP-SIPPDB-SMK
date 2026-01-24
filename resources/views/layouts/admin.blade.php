<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard PPDB SMK SBI')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body class="bg-[#F8F9FC] text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside
            class="w-64 bg-white border-r border-gray-200 flex flex-col fixed md:relative h-full transition-all duration-300 z-50">
            <div class="h-20 flex items-center px-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                        <i class="fa-solid fa-user-shield text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg leading-tight text-slate-800">Admin Panel</h1>
                        <p class="text-xs text-slate-500">PPDB SMK SBI</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-gauge-high w-5"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4 mb-2">Pendaftaran</p>

                <a href="{{ route('admin.calon-siswa.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.calon-siswa.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-users w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Data Pendaftar</span>
                </a>

                <a href="{{ route('admin.verifikasi.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.verifikasi.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-regular fa-folder-open w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Verifikasi Berkas</span>
                </a>

                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4 mb-2">Master Data</p>

                <a href="{{ route('admin.periode.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.periode.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-calendar-days w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Periode PPDB</span>
                </a>

                <a href="{{ route('admin.gelombang.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.gelombang.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-layer-group w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Gelombang</span>
                </a>

                <a href="{{ route('admin.jurusan.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.jurusan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-shapes w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Jurusan</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-users-gear w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Manajemen User</span>
                </a>

                <a href="{{ route('admin.pengumuman.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.pengumuman.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-bullhorn w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Pengumuman</span>
                </a>

                 <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4 mb-2">Laporan</p>

                <a href="{{ route('admin.laporan.index') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-gray-50 hover:text-blue-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-file-export w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Laporan PPDB</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100">
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold shadow-sm uppercase">
                        {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold truncate w-32 text-slate-800">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-slate-500 hover:text-blue-700 text-sm px-2 transition-colors w-full">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative">

            <header
                class="bg-white h-20 border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">@yield('header_title', 'Dashboard Admin')</h2>
                    <p class="text-slate-500 text-sm mt-0.5">@yield('header_subtitle', 'Pantau aktivitas PPDB secara real-time')</p>
                </div>

                <div class="flex items-center gap-4">
                    {{-- <div class="relative hidden md:block">
                        <input type="text" placeholder="Cari data..."
                            class="bg-gray-100 border-none rounded-full pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                         <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-2.5 text-gray-400 text-sm"></i>
                    </div> --}}

                    {{-- <div class="relative">
                        <button
                            class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-slate-600 hover:bg-gray-50 transition-colors">
                            <i class="fa-regular fa-bell"></i>
                            <span
                                class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                    </div> --}}
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
