<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SI PPDB SMK') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
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