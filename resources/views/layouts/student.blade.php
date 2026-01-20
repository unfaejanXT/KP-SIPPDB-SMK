<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard PPDB SMK SBI')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

<body class="bg-[#F8F9FC] text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside
            class="w-64 bg-[#1E3A8A] text-white flex flex-col fixed md:relative h-full transition-all duration-300 z-50">
            <div class="h-20 flex items-center px-6 border-b border-blue-800/50">
                <div class="flex items-center gap-3">
                    <div class="bg-white/10 p-2 rounded-lg">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg leading-tight">SMK SBI</h1>
                        <p class="text-xs text-blue-200">Portal PPDB</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-[#10B981] text-white shadow-lg shadow-green-500/20' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-gauge-high w-5"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="{{ route('pendaftaran.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('pendaftaran.edit') ? 'bg-[#10B981] text-white shadow-lg shadow-green-500/20' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }} rounded-lg transition-colors group">
                    <i class="fa-regular fa-pen-to-square w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Edit Pendaftaran</span>
                </a>

                <a href="{{ route('dashboard.berkas') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard.berkas') ? 'bg-[#10B981] text-white shadow-lg shadow-green-500/20' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }} rounded-lg transition-colors group">
                    <i class="fa-regular fa-folder-open w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Kelola Berkas</span>
                </a>

                <a href="{{ route('dashboard.cetak') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard.cetak') ? 'bg-[#10B981] text-white shadow-lg shadow-green-500/20' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-print w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Cetak Bukti</span>
                </a>

                <a href="{{ route('dashboard.pengumuman') }}"
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard.pengumuman') ? 'bg-[#10B981] text-white shadow-lg shadow-green-500/20' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }} rounded-lg transition-colors group">
                    <i class="fa-solid fa-bullhorn w-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium text-sm">Pengumuman</span>
                </a>
            </nav>

            <div class="p-4 border-t border-blue-800/50">
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-sm font-bold shadow-md uppercase">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold truncate w-32">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-300">Calon Siswa</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-blue-200 hover:text-white text-sm px-2 transition-colors w-full">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-hidden relative">

            <header
                class="bg-white h-20 border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">@yield('header_title', 'Dashboard')</h2>
                    <p class="text-slate-500 text-sm mt-0.5">@yield('header_subtitle', 'Selamat datang di Portal PPDB SMK SBI')</p>
                </div>

                <div class="relative">
                    <button
                        class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-slate-600 hover:bg-gray-50 transition-colors">
                        <i class="fa-regular fa-bell"></i>
                        <span
                            class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
