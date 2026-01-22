<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-screen">
        
        <!-- Brand Section (Left) -->
        <div class="bg-gradient-to-br from-red-800 to-red-900 text-white lg:w-1/2 md:w-5/12 w-full flex flex-col justify-center relative overflow-hidden p-8 md:p-12 lg:p-16 order-first">
            <!-- Back Button -->
            <a href="{{ url('/') }}" class="absolute top-6 left-6 z-20 flex items-center text-red-100 hover:text-white transition duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="text-sm font-medium">Kembali</span>
            </a>
            
            <!-- Decorative Circles -->
            <div class="absolute top-0 left-0 -mt-20 -ml-20 w-64 h-64 bg-red-700 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 -mb-20 -mr-20 w-80 h-80 bg-red-950 rounded-full opacity-30 blur-3xl"></div>
            
            <div class="relative z-10 text-center md:text-left selection:bg-red-500 selection:text-white max-w-xl mx-auto md:mx-0">
                <img src="{{ asset('assets/images/sbi-logo.png') }}" alt="Logo SMKS SBI" class="h-24 w-auto mb-8 mx-auto md:mx-0 bg-white rounded-2xl p-3 shadow-xl transform hover:scale-105 transition duration-300">
                <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">Sistem Informasi Pendaftaran</h2>
                <p class="text-red-100 text-lg lg:text-xl font-medium mb-8">SMKS Solusi Bangun Indonesia Cianjur</p>
                <div class="hidden md:block">
                    <p class="text-red-200 text-base leading-relaxed max-w-lg">Bergabunglah dengan kami sekarang! Buat akun baru untuk memulai perjalanan pendidikan Anda di sekolah unggulan.</p>
                </div>
            </div>

             <!-- Footer for Desktop (Left side) -->
             <div class="absolute bottom-6 left-6 text-xs text-red-300/60 hidden md:block">
                &copy; {{ date('Y') }} SMKS Solusi Bangun Indonesia Cianjur.
            </div>
        </div>

        <!-- Form Section (Right) -->
        <div class="bg-white lg:w-1/2 md:w-7/12 w-full flex flex-col justify-center p-8 md:p-12 lg:p-24 shadow-2xl md:shadow-none z-10">
            <div class="w-full max-w-md mx-auto">
                <div class="mb-10 text-center md:text-left">
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Pendaftaran Siswa Baru</h3>
                    <p class="text-gray-500">Lengkapi data berikut untuk membuat akun</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-red-500 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" required autofocus autocomplete="name"
                                class="block w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition duration-200 ease-in-out sm:text-sm font-medium"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-red-500 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" required autocomplete="username"
                                class="block w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition duration-200 ease-in-out sm:text-sm font-medium"
                                placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative group" x-data="{ show: false }">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-red-500 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" type="password" id="password" name="password" required autocomplete="new-password"
                                class="block w-full pl-11 pr-12 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition duration-200 ease-in-out sm:text-sm font-medium"
                                placeholder="Buat kata sandi yang aman">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-sm leading-5 overflow-hidden">
                                <svg x-show="!show" class="h-5 w-5 text-gray-400 hover:text-red-600 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" x-cloak class="h-5 w-5 text-gray-400 hover:text-red-600 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative group" x-data="{ show: false }">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-red-500 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                                class="block w-full pl-11 pr-12 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition duration-200 ease-in-out sm:text-sm font-medium"
                                placeholder="Ulangi kata sandi Anda">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-sm leading-5 overflow-hidden">
                                <svg x-show="!show" class="h-5 w-5 text-gray-400 hover:text-red-600 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" x-cloak class="h-5 w-5 text-gray-400 hover:text-red-600 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-red-500/30 text-base font-bold text-white bg-gradient-to-r from-red-600 to-red-800 hover:from-red-700 hover:to-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 transform hover:-translate-y-1 active:scale-95">
                            Daftar
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-sm text-gray-500">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-bold text-red-700 hover:text-red-900 transition duration-200 ml-1 hover:underline">
                            Masuk
                        </a>
                    </p>
                </div>
                
                <!-- Footer for Mobile -->
                <div class="mt-8 text-center text-xs text-gray-400 md:hidden">
                    &copy; {{ date('Y') }} SMKS SBI Cianjur.
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
