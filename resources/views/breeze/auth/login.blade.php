<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-slate-100 px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Session Status -->
        <div class="w-full max-w-5xl mb-4">
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </div>

        <div class="flex flex-col md:flex-row bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl w-full border border-gray-100">
            
            <!-- Brand Section (Left) -->
            <div class="bg-gradient-to-br from-red-800 to-red-900 text-white p-8 md:p-12 md:w-5/12 flex flex-col justify-center relative overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute top-0 left-0 -mt-10 -ml-10 w-40 h-40 bg-red-700 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute bottom-0 right-0 -mb-10 -mr-10 w-40 h-40 bg-red-950 rounded-full opacity-40 blur-3xl"></div>
                
                <div class="relative z-10 text-center md:text-left selection:bg-red-500 selection:text-white">
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight leading-tight">Sistem Informasi Pendaftaran</h2>
                    <p class="mt-4 text-red-100 text-lg font-medium">SMKS Solusi Bangun Indonesia Cianjur</p>
                    <div class="mt-8 hidden md:block">
                        <p class="text-red-200 text-sm leading-relaxed">Silakan masuk untuk mengakses akun Anda dan melanjutkan proses pendaftaran peserta didik baru.</p>
                    </div>
                </div>
            </div>

            <!-- Form Section (Right) -->
            <div class="p-8 md:p-12 md:w-7/12 flex flex-col justify-center bg-white">
                <div class="mb-8 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h3>
                    <p class="text-gray-500 mt-2 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Nomor HP -->
                    <div>
                        <label for="nohp" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon/WhatsApp</label>
                        <div class="relative">
                            <input type="text" id="nohp" name="nohp" required autofocus
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out"
                                placeholder="Contoh: 081234567890">
                        </div>
                        <x-input-error :messages="$errors->get('nohp')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required autocomplete="current-password"
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out"
                                placeholder="Masukkan kata sandi Anda">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-red-700 focus:ring-red-500 border-gray-300 rounded cursor-pointer">
                            <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer select-none">
                                Ingat Saya
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-red-700 hover:text-red-800 transition duration-200">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-red-700 to-red-800 hover:from-red-800 hover:to-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 transform hover:-translate-y-0.5 active:scale-95">
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}" class="font-bold text-red-700 hover:text-red-900 transition duration-200 ml-1">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Footer for mobile/desktop spacing -->
        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} SMKS Solusi Bangun Indonesia Cianjur.
        </div>
    </div>
</x-guest-layout>