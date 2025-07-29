<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex items-center justify-center min-h-screen p-6 md:p-8 bg-gray-100">
        <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl">
            <!-- Left Section -->
            <div class="bg-red-600 text-white p-8 md:w-1/2 flex flex-col justify-center">
                <h2 class="text-2xl font-bold">Sistem Informasi Pendaftaran</h2>
                <p class="mt-4">SMKS Solusi Bangun Indonesia Cianjur</p>
                <p class="mt-2">Kuki harus diaktifkan pada peramban Anda</p>
            </div>
            <!-- Right Section -->
            <div class="p-8 md:w-1/2">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Sudah memiliki akun?</h3>
                <form method="POST" action="{{ route('login') }}">

                    @csrf
                    <div class="mb-4">
                        <label for="nohp" class="block text-gray-700">Nomor Telepon/WhatsApp</label>
                        <input type="text" id="nohp" name="nohp"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600 focus:ring focus:ring-red-300 focus:ring-opacity-50"
                            placeholder="08">
                        <x-input-error :messages="$errors->get('nohp')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600
                        focus:ring focus:ring-red-300 focus:ring-opacity-50" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-gray-900">Ingat Saya</label>
                    </div>
                    <div class="mb-4">
                        <button type="submit"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700">Masuk</button>
                    </div>
                    <div class="text-center">
                        <a href="#" class="text-red-600 hover:text-red-700">Lupa nama pengguna dan kata sandi Anda?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-guest-layout>