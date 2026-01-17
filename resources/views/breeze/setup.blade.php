<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <div class="mb-4 text-center">
                <h1 class="text-2xl font-bold text-gray-800">First Time Setup</h1>
                <p class="text-gray-600 mt-2">Selamat Datang! Silakan buat akun Admin Utama.</p>
            </div>

            <form method="POST" action="{{ route('setup.store') }}">
                @csrf

                <!-- Username -->
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="username">
                        Username
                    </label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" 
                           id="username" type="text" name="username" required autofocus placeholder="admin" />
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="nohp">
                        No Handphone / WhatsApp
                    </label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" 
                           id="nohp" type="text" name="nohp" required placeholder="08..." />
                    @error('nohp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password">
                        Password
                    </label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" 
                           id="password" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Confirm Password
                    </label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" 
                           id="password_confirmation" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center">
                        Buat Akun & Selesai
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
