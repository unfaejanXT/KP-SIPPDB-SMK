<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atomic Design - PPDB SMKS Solusi Bangun Indonesia</title>
    <link rel="icon" href="{{ asset('assets/images/sbi-logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts - Semua library sudah include di Vite bundle -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden bg-white dark:bg-gray-950">
        <!-- Sidebar -->
        @include('sandbox.atomic.partials.sidebar')

        <!-- Main Content Wrapper -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#FAFAFA] dark:bg-white overflow-hidden">
            <!-- Content Scroll Area -->
            <div class="flex-1 overflow-y-auto p-8 lg:p-12">
                <div class="max-w-5xl mx-auto">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
