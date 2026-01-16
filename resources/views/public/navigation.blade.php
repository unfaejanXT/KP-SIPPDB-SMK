<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="{ 'bg-white/95 backdrop-blur-md shadow-md': scrolled, 'bg-white shadow-sm': !scrolled }"
     class="sticky w-full z-50 transition-all duration-300 top-0 left-0 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo Section -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex-shrink-0 transition transform hover:scale-105">
                    <x-application-logo class="block h-10 w-auto fill-current text-red-700" />
                </a>
                <a href="{{ url('/') }}" class="flex flex-col">
                    <span class="text-lg font-extrabold tracking-tight text-gray-900 leading-none">PPDB ONLINE</span>
                    <span class="text-xs font-semibold text-red-700 tracking-wider">SMKS SOLUSI BANGUN INDONESIA</span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-sm font-medium {{ request()->is('/') ? 'text-red-700' : 'text-gray-600 hover:text-red-600' }} transition duration-150 ease-in-out">
                    Beranda
                </a>
                <a href="{{ url('/profil') }}" class="text-sm font-medium {{ request()->is('profil') ? 'text-red-700' : 'text-gray-600 hover:text-red-600' }} transition duration-150 ease-in-out">
                    Profil Sekolah
                </a>
                <a href="{{ url('/') }}#panduan" class="text-sm font-medium text-gray-600 hover:text-red-600 transition duration-150 ease-in-out">
                    Panduan
                </a>
                
                <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-red-700 transition px-3 py-2 rounded-lg hover:bg-red-50">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-lg text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Daftar Akun
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-red-600 hover:bg-red-50 focus:outline-none transition duration-150 ease-in-out">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white border-t border-gray-100 shadow-xl rounded-b-2xl absolute w-full left-0 z-40">
        <div class="pt-2 pb-6 px-4 space-y-1">
            <a href="{{ url('/') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->is('/') ? 'border-red-500 text-red-700 bg-red-50' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-gray-50' }} text-base font-medium rounded-r-md transition">
                Beranda
            </a>
            <a href="{{ url('/profil') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->is('profil') ? 'border-red-500 text-red-700 bg-red-50' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-gray-50' }} text-base font-medium rounded-r-md transition">
                Profil Sekolah
            </a>
            <a href="{{ url('/') }}#panduan" class="block pl-3 pr-4 py-3 border-l-4 border-transparent text-gray-600 hover:text-red-600 hover:bg-gray-50 text-base font-medium rounded-r-md transition">
                Panduan Pendaftaran
            </a>

            <div class="mt-4 pt-4 border-t border-gray-100 grid gap-3">
                <a href="{{ route('login') }}" class="flex justify-center items-center px-4 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="flex justify-center items-center px-4 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-red-700 hover:bg-red-800 shadow-md transition">
                    Daftar Akun
                </a>
            </div>
        </div>
    </div>
</nav>
