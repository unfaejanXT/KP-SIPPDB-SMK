<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DASHBOARD ADMIN') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons + CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div x-data class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        @include('adminpanel.layouts.sidebar')

        <!-- Wrapper untuk Konten -->
        <div id="contentWrapper" class="flex-1 flex flex-col ml-64">

            <!-- Navigation Bar -->
            @include('adminpanel.layouts.navigation')

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const contentWrapper = document.getElementById('contentWrapper');
            const toggleButton = document.getElementById('toggleSidebar');

            // Pastikan sidebar dimulai dengan posisi terlihat
            sidebar.classList.add('translate-x-0');
            contentWrapper.classList.add('ml-64');

            toggleButton.addEventListener('click', function () {
                // Toggle sidebar visibility
                if (sidebar.classList.contains('translate-x-0')) {
                    // Jika sidebar terlihat, sembunyikan
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');

                    // Hapus margin-left dari konten utama
                    contentWrapper.classList.remove('ml-64');
                } else {
                    // Jika sidebar tersembunyi, tampilkan
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');

                    // Tambahkan margin-left ke konten utama
                    contentWrapper.classList.add('ml-64');
                }
            });
        });




        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
        });
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type') }}";
            switch (type) {
                case 'info':
                    Toast.fire({
                        icon: 'info',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'success':
                    Toast.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'warning':
                    Toast.fire({
                        icon: 'warning',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'error':
                    Toast.fire({
                        icon: 'error',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'dialog_error':
                    Swal.fire({
                        icon: 'error',
                        title: "Ooops",
                        text: "{{ Session::get('message') }}",
                        timer: 3000
                    });
                    break;
            }
        @endif
        @if ($errors->any())
            @php    $list = null; @endphp
            @foreach ($errors->all() as $error)
                @php        $list .= '<li>' . $error . '</li>'; @endphp
            @endforeach
            Swal.fire({
                type: 'error',
                title: "Ooops",
                html: "<ul>{!! $list !!}</ul>",
            });
        @endif
    </script>
</body>

</html>