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
            </div>

             <!-- Footer for Desktop (Left side) -->
             <div class="absolute bottom-6 left-6 text-xs text-red-300/60 hidden md:block">
                &copy; {{ date('Y') }} SMKS Solusi Bangun Indonesia Cianjur.
            </div>
        </div>

        <!-- Content Section (Right) -->
        <div class="bg-white lg:w-1/2 md:w-7/12 w-full flex flex-col justify-center p-8 md:p-12 lg:p-24 shadow-2xl md:shadow-none z-10">
            <div class="w-full max-w-md mx-auto">
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 mb-8 mx-auto md:mx-0">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $title ?? 'Pendaftaran Ditutup' }}</h3>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        {{ $message ?? 'Mohon maaf, saat ini tidak ada gelombang pendaftaran yang aktif. Pantau terus informasi terbaru dari kami.' }}
                    </p>
                    
    <div class="space-y-4">
                        <a href="{{ url('/') }}" class="w-full flex justify-center py-4 px-6 border border-gray-200 rounded-xl shadow-sm text-base font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
                
                <!-- Footer for Mobile -->
                <div class="mt-8 text-center text-xs text-gray-400 md:hidden">
                    &copy; {{ date('Y') }} SMKS SBI Cianjur.
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
