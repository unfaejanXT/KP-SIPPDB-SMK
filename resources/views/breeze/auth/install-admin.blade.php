<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalasi Sistem - PPDB SMKS Solusi Bangun Indonesia</title>
    <link rel="icon" href="{{ asset('assets/images/sbi-logo.png') }}" type="image/png">
    
    {{-- Vite Assets - Semua assets sudah lokal --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-red-900/20"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6">
            <div class="text-center mb-8">
                 <span class="inline-block py-1 px-3 rounded-full bg-red-600/20 border border-red-500 text-red-100 text-xs font-semibold tracking-wider mb-4 uppercase">
                    Setup Awal
                </span>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang</h1>
                <p class="text-gray-400 text-sm">Sistem mendeteksi belum ada pengguna. Silakan buat akun Administrator pertama Anda.</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-8 shadow-2xl">
                <form method="POST" action="{{ route('install.store') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full bg-gray-900/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 placeholder-gray-500 transition-colors"
                            placeholder="Administrator">
                        @error('name')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-gray-900/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 placeholder-gray-500 transition-colors"
                            placeholder="admin@sekolah.sch.id">
                        @error('email')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full bg-gray-900/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 placeholder-gray-500 transition-colors"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full bg-gray-900/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 placeholder-gray-500 transition-colors"
                            placeholder="••••••••">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold py-3 rounded-xl transition duration-300 transform hover:scale-[1.02] shadow-lg shadow-red-900/50">
                        Buat Akun Administrator
                    </button>
                    
                    <p class="mt-6 text-center text-xs text-gray-500">
                        Akun ini akan memiliki hak akses penuh ke sistem.
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
