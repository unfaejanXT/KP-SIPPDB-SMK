<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100 px-4 py-12">
        <div class="w-full sm:max-w-md bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-red-800 to-red-900 p-6 text-center">
                <h2 class="text-xl font-bold text-white tracking-tight">Atur Ulang Kata Sandi</h2>
                <p class="text-red-100 text-sm mt-1">Masukkan email untuk menerima tautan reset</p>
            </div>
            
            <div class="p-8">
                <div class="mb-6 text-sm text-gray-600 leading-relaxed text-center">
                    Lupa kata sandi Anda? Tidak masalah. Masukkan alamat email Anda yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="appearance-none block w-full px-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent sm:text-sm transition duration-200 ease-in-out"
                                placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 font-medium text-xs" />
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-red-700 to-red-800 hover:from-red-800 hover:to-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 transform hover:-translate-y-0.5 active:scale-95">
                            Kirim Tautan Reset
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-red-700 transition duration-200 flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Halaman Masuk
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} SMKS Solusi Bangun Indonesia Cianjur.
        </div>
    </div>
</x-guest-layout>
