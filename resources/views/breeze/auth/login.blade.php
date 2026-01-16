<x-guest-layout>
    
    <div class="flex flex-col items-center justify-center min-h-screen bg-slate-50 px-4 sm:px-6 lg:px-8">
        
        <!-- Session Status -->
        <div class="w-full max-w-5xl mb-4">
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </div>

        <div class="flex flex-col md:flex-row bg-white shadow-2xl rounded-2xl overflow-hidden max-w-5xl w-full">
            
            <!-- Brand Section (Left) -->
            <div class="bg-gradient-to-br from-red-700 to-red-900 text-white p-8 md:p-12 md:w-5/12 flex flex-col justify-center relative overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute top-0 left-0 -mt-10 -ml-10 w-40 h-40 bg-red-600 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute bottom-0 right-0 -mb-10 -mr-10 w-40 h-40 bg-red-800 rounded-full opacity-30 blur-2xl"></div>
                
                <div class="relative z-10 text-center md:text-left">
                    <h2 class="text-3xl font-extrabold tracking-tight">Sistem Informasi Pendaftaran</h2>
                    <p class="mt-4 text-red-100 text-lg">SMKS Solusi Bangun Indonesia Cianjur</p>
                    <div class="mt-8 hidden md:block">
                        <p class="text-red-200 text-sm">Silakan masuk untuk mengakses akun Anda dan melanjutkan proses pendaftaran.</p>
                    </div>
                </div>
            </div>

            <!-- Form Section (Right) -->
            <div class="p-8 md:p-12 md:w-7/12 flex flex-col justify-center">
                <div class="mb-8 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h3>
                    <p class="text-gray-500 mt-2">Masuk ke akun Anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Nomor HP -->
                    <div>
                        <label for="nohp" class="block text-sm font-medium text-gray-700">Nomor Telepon/WhatsApp</label>
                        <div class="mt-1">
                            <input type="text" id="nohp" name="nohp" required autofocus
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm transition duration-200"
                                placeholder="Contoh: 081234567890">
                        </div>
                        <x-input-error :messages="$errors->get('nohp')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="mt-1">
                            <input type="password" id="password" name="password" required autocomplete="current-password"
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm transition duration-200"
                                placeholder="Masukkan kata sandi Anda">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded cursor-pointer">
                            <label for="remember" class="ml-2 block text-sm text-gray-900 cursor-pointer">
                                Ingat Saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-red-600 hover:text-red-500 transition duration-200">
                                Lupa Kata Sandi?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 transform hover:-translate-y-0.5">
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-500 transition duration-200">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>