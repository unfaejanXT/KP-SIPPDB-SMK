<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <x-application-logo class="block h-14 w-auto fill-current text-gray-800" />
                        <span class="ml-2 text-lg font-bold text-gray-800 hidden md:block">SMKS SOLUSI BANGUN INDONESIA CIANJUR</span>
                    </a>
                </div>
            </div>
            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{url('/')}}" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Beranda</a>
                <a href="{{url('/profil')}}" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Profil Sekolah</a>
                <a href="#panduan-pendaftaran" class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Panduan Pendaftaran</a>
                <!-- Buttons -->
                <x-primary-button>
                    <a href="{{ route('login') }}">Login</a>
                </x-primary-button>
                <x-secondary-button>
                    <a href="{{ route('daftarakun') }}">Register</a>
                </x-secondary-button>
            </div>
            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{url('/')}}" class="block text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Beranda</a>
            <a href="{{url('/profil')}}" class="block text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Profil Sekolah</a>
            <a href="#panduan-pendaftaran" class="block text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">Panduan Pendaftaran</a>
            <!-- Buttons -->
            <x-primary-button class="w-full">
                <a href="{{ route('login') }}">Login</a>
            </x-primary-button>
            <x-secondary-button class="w-full">
                <a href="{{ route('daftarakun') }}">Register</a>
            </x-secondary-button>
        </div>
    </div>
</nav>
