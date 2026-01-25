<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard PPDB SMK SBI')</title>

    {{-- Vite Assets - Semua assets sudah lokal --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Scrollbar for nicer look */
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

<body class="bg-[#F8F9FC] text-slate-800" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 z-40 md:hidden glass"></div>

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 flex flex-col transition-transform duration-300 md:translate-x-0 md:static md:inset-0 shadow-xl md:shadow-none">
            <div class="h-20 flex items-center px-6 border-b border-gray-100 justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-red-50 text-red-600 p-2 rounded-lg">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg leading-tight text-slate-800">SMK SBI</h1>
                        <p class="text-xs text-slate-500">Portal PPDB</p>
                    </div>
                </div>
                <!-- Close Button Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-red-500">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-700' : 'text-slate-600 hover:bg-gray-50 hover:text-red-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-gauge-high w-5"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="{{ route('pendaftaran.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('pendaftaran.edit') ? 'bg-red-50 text-red-700' : 'text-slate-600 hover:bg-gray-50 hover:text-red-700' }} rounded-lg transition-colors group">
                    <i class="fa-regular fa-pen-to-square w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Edit Pendaftaran</span>
                </a>

                <a href="{{ route('dashboard.berkas') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard.berkas') ? 'bg-red-50 text-red-700' : 'text-slate-600 hover:bg-gray-50 hover:text-red-700' }} rounded-lg transition-colors group">
                    <i class="fa-regular fa-folder-open w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Kelola Berkas</span>
                </a>

                <a href="{{ route('dashboard.cetak') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard.cetak') ? 'bg-red-50 text-red-700' : 'text-slate-600 hover:bg-gray-50 hover:text-red-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-print w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Cetak Bukti</span>
                </a>

                <a href="{{ route('dashboard.pengumuman') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard.pengumuman') ? 'bg-red-50 text-red-700' : 'text-slate-600 hover:bg-gray-50 hover:text-red-700' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-bullhorn w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Pengumuman</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative w-full">

            <header
                class="bg-white h-20 border-b border-gray-100 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <!-- Hamburger Button -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden w-10 h-10 -ml-2 rounded-lg text-slate-600 hover:bg-gray-50 flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>

                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-slate-800">@yield('header_title', 'Dashboard')</h2>
                        <p class="hidden md:block text-slate-500 text-sm mt-0.5">@yield('header_subtitle', 'Selamat datang di Portal PPDB SMK SBI')</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @php
                        $pendaftaran = Auth::user()->pendaftaran;
                        $foto = $pendaftaran && $pendaftaran->pas_foto ? asset('storage/' . $pendaftaran->pas_foto) : null;
                        $nama = $pendaftaran && $pendaftaran->nama_lengkap ? $pendaftaran->nama_lengkap : Auth::user()->name;
                    @endphp
                    
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" 
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="shrink-0">
                                @if($foto)
                                    <img src="{{ $foto }}" alt="Profile" class="w-9 h-9 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-sm font-bold shadow-sm uppercase border-2 border-red-200">
                                        {{ substr($nama, 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold text-slate-800">{{ $nama }}</p>
                                <p class="text-xs text-slate-500">Calon Siswa</p>
                            </div>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400 hidden md:block" :class="profileOpen ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" 
                            @click.away="profileOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                            
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-slate-800">{{ $nama }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <div class="border-t border-gray-100 my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                    class="w-full flex items-center gap-3 px-4 py-2.5 text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                                    <span class="text-sm font-medium">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8 w-full">
                @yield('content')
            </main>
        </div>
    </div>
    @include('breeze.partials.alerts')
</body>

</html>
