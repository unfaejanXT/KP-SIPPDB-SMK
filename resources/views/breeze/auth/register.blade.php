<x-guest-layout>
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
                <h3 class="text-xl font-semibold text-gray-800">Pendaftaran</h3>
                <p class="mb-3 text-gray-700">Untuk melanjutkan pendaftaran, silahkan masukkan informasi berikut:</p>
                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <!-- NISN -->
                    <div class="mb-3">
                        <label for="username" class="block text-gray-700">NISN (Nomor Induk Siswa Nasional)</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600 focus:ring focus:ring-red-300 focus:ring-opacity-50"
                            placeholder="Masukkan 10 digit NISN">
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- No Whatsapp Yang Aktif -->
                    <div class="mb-3">
                        <label for="nohp" class="block text-gray-700">Nomor Telepon/WhatsApp</label>
                        <input type="text" id="nohp" name="nohp"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600 focus:ring focus:ring-red-300 focus:ring-opacity-50"
                            placeholder="Pastikan nomor ini aktif untuk komunikasi.">
                        <x-input-error :messages="$errors->get('nohp')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600
                            focus:ring focus:ring-red-300 focus:ring-opacity-50" placeholder="Masukkan Kata Sandi">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="block text-gray-700">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600
                            focus:ring focus:ring-red-300 focus:ring-opacity-50" placeholder="Masukkan kembali kata sandi">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <button type="submit"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700">Daftar</button>
                    </div>
                    <div class="text-center">
                        <a href="#" class="text-red-600 hover:text-red-700">Lupa nama pengguna dan kata sandi Anda?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
