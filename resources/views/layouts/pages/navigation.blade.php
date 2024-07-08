<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <x-application-logo class="block h-14 w-auto fill-current text-gray-800" /> <!-- Ubah h-12 menjadi h-14 atau sesuai yang diinginkan -->
                        <span class="ml-2 text-lg font-bold text-gray-800 hidden md:block">SMKS SOLUSI BANGUN INDONESIA CIANJUR</span>
                    </a>
                </div>
            </div>
            <!-- Navigation Links and Buttons -->
            <div class="flex items-center space-x-4">
                <a href="{{url('/')}}" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">Beranda</a>
                <a href="{{url('/profil')}}" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">Profil Sekolah</a>
                <a href="#panduan-pendaftaran" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">Panduan Pendaftaran</a>
                <!-- Buttons -->
                <x-primary-button>
                    <a href="{{ route('login') }}">Login</a>
                </x-primary-button>
                <x-secondary-button>
                    <a href="{{ route('register') }}">Register</a>
                </x-secondary-button>
            </div>
        </div>
    </div>
</nav>
