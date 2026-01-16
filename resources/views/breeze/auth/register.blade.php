<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-slate-100 px-4 sm:px-6 lg:px-8 py-12">
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
                        <p class="text-red-200 text-sm leading-relaxed">Bergabunglah dengan kami sekarang! Buat akun baru untuk memulai perjalanan pendidikan Anda di sekolah unggulan.</p>
                    </div>
                </div>
            </div>

            <!-- Form Section (Right) -->
            <div class="p-8 md:p-12 md:w-7/12 flex flex-col justify-center bg-white">
                <div class="mb-8 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-gray-900">Pendaftaran Siswa Baru</h3>
                    <p class="text-gray-500 mt-2 text-sm">Lengkapi data berikut untuk membuat akun</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- NISN -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">NISN (Nomor Induk Siswa Nasional)</label>
                        <div class="relative">
                            <input type="text" id="username" name="username" required autofocus
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out"
                                placeholder="Masukkan 10 digit NISN">
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- No Whatsapp -->
                    <div>
                        <label for="nohp" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon/WhatsApp</label>
                        <div class="relative">
                            <input type="text" id="nohp" name="nohp" required
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out"
                                placeholder="Contoh: 081234567890">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Pastikan nomor aktif dan terhubung ke WhatsApp.</p>
                        <x-input-error :messages="$errors->get('nohp')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" type="password" id="password" name="password" required autocomplete="new-password"
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out pr-12"
                                placeholder="Buat kata sandi yang aman">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg x-show="!show" class="h-5 w-5 text-gray-500 hover:text-red-700 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" x-cloak class="h-5 w-5 text-gray-500 hover:text-red-700 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out pr-12"
                                placeholder="Ulangi kata sandi Anda">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg x-show="!show" class="h-5 w-5 text-gray-500 hover:text-red-700 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" x-cloak class="h-5 w-5 text-gray-500 hover:text-red-700 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-red-700 to-red-800 hover:from-red-800 hover:to-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 transform hover:-translate-y-0.5 active:scale-95">
                            Daftar
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-bold text-red-700 hover:text-red-900 transition duration-200 ml-1">
                            Masuk
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
