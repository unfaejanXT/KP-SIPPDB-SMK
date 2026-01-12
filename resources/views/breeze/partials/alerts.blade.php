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
