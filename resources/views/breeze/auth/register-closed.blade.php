<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-slate-100 px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl w-full border border-gray-100">
            
            <!-- Brand Section (Left) -->
            <div class="bg-gradient-to-br from-red-800 to-red-900 text-white p-8 md:p-12 md:w-5/12 flex flex-col justify-center relative overflow-hidden">
                <!-- Back Button -->
                <a href="{{ url('/') }}" class="absolute top-6 left-6 z-20 flex items-center text-red-100 hover:text-white transition duration-200 group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="text-sm font-medium">Kembali ke Beranda</span>
                </a>
                
                <!-- Decorative Circles -->
                <div class="absolute top-0 left-0 -mt-10 -ml-10 w-40 h-40 bg-red-700 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute bottom-0 right-0 -mb-10 -mr-10 w-40 h-40 bg-red-950 rounded-full opacity-40 blur-3xl"></div>
                
                <div class="relative z-10 text-center md:text-left selection:bg-red-500 selection:text-white">
                    <img src="{{ asset('assets/images/sbi-logo.png') }}" alt="Logo SMKS SBI" class="h-20 w-auto mb-6 mx-auto md:mx-0 bg-white rounded-xl p-2 shadow-lg">
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight leading-tight">Sistem Informasi Pendaftaran</h2>
                    <p class="mt-4 text-red-100 text-lg font-medium">SMKS Solusi Bangun Indonesia Cianjur</p>
                </div>
            </div>

            <!-- Content Section (Right) -->
            <div class="p-8 md:p-12 md:w-7/12 flex flex-col justify-center bg-white">
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mb-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $title ?? 'Pendaftaran Ditutup' }}</h3>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        {{ $message ?? 'Mohon maaf, saat ini tidak ada gelombang pendaftaran yang aktif. Silahkan coba lagi nanti atau hubungi administrator sekolah untuk informasi lebih lanjut.' }}
                    </p>
                    
                    <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Informasi Kontak</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>Silahkan hubungi admin melalui kontak berikut jika Anda memiliki pertanyaan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="https://wa.me/6281234567890" target="_blank" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            Hubungi Admin via WhatsApp
                        </a>
                        
                        <a href="{{ url('/') }}" class="w-full flex justify-center py-3.5 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300">
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center text-xs text-gray-400">
             &copy; {{ date('Y') }} SMKS Solusi Bangun Indonesia Cianjur.
        </div>
    </div>
</x-guest-layout>
