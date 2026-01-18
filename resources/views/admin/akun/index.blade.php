@extends('admin.layouts.app')
@section('navlabel', 'Kelola Akun')

@section('content')
<div class="">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Periode Pendaftaran Calon Siswa</h1>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden mt-5">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">Daftar Akun</h3>
            </div>
            <div class="p-6">
                <!-- display class is for DataTables vanilla styling -->
                <table class="w-full data-table display hover stripe">
                    <thead>
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">NISN</th>
                            <th class="text-left">Nomor Handphone</th>
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