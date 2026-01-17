@extends('admin.layouts.app')
@section('navlabel', 'Kelola Akun')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Periode Pendaftaran Calon Siswa</h1>

    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Laravel 11 Yajra Datatables Tutorial - ItSolutionStuff.com</h3>
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nomor Handphone</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.kelolaakun') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'username', name: 'username' },
                { data: 'nohp', name: 'nohp' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

    });
</script>

@endsection