@extends('layouts.admin')

@section('title', 'Kelola Akun Pengguna')
@section('header_title', 'Kelola Akun Pengguna')
@section('header_subtitle', 'Atur hak akses dan pengguna sistem')

@section('content')
    <div class="space-y-6">

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center">
                <div class="p-3 bg-slate-100 rounded-lg text-slate-600 mr-4">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</div>
                    <div class="text-sm text-slate-500">Total Pengguna</div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center">
                <div class="p-3 bg-red-50 rounded-lg text-red-500 mr-4">
                    <i class="fa-solid fa-user-shield text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-slate-800">{{ $totalAdmin }}</div>
                    <div class="text-sm text-slate-500">Administrator</div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center">
                <div class="p-3 bg-blue-50 rounded-lg text-blue-500 mr-4">
                     <i class="fa-solid fa-user-tie text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-slate-800">{{ $totalOperator }}</div>
                    <div class="text-sm text-slate-500">Operator</div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center">
                <div class="p-3 bg-green-50 rounded-lg text-green-500 mr-4">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</div>
                    <div class="text-sm text-slate-500">Aktif</div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <!-- Toolbar -->
            <div class="p-4 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <form action="{{ route('admin.users.index') }}" method="GET" class="relative w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..."
                        class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 absolute left-3 top-2.5 text-sm"></i>
                </form>

                <div class="flex items-center gap-2">
                    <!-- Filter Role -->
                    <form action="{{ route('admin.users.index') }}" method="GET" id="filterForm">
                         <input type="hidden" name="search" value="{{ request('search') }}">
                        <div class="relative">
                            <select name="role" onchange="document.getElementById('filterForm').submit()"
                                class="appearance-none bg-white border border-slate-200 text-slate-600 py-2 pl-3 pr-8 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 cursor-pointer">
                                <option value="">Semua Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                             <i class="fa-solid fa-chevron-down text-slate-400 absolute right-2 top-3 text-xs pointer-events-none"></i>
                        </div>
                    </form>

                    <a href="{{ route('admin.users.create') }}"
                        class="bg-[#0f172a] hover:bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                        <i class="fa-solid fa-plus text-sm"></i>
                        Tambah Pengguna
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 font-medium">
                        <tr>
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Terdaftar</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-xs font-bold uppercase">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-slate-800">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach($user->roles as $role)
                                    @php
                                        $color = match($role->name) {
                                            'admin' => 'bg-red-100 text-red-600 border-red-200',
                                            'user' => 'bg-sky-100 text-sky-600 border-sky-200',
                                            default => 'bg-slate-100 text-slate-600 border-slate-200'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $color }}">{{ ucfirst($role->name) }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-600 border border-green-200">Aktif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                                {{ $user->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Tidak ada data pengguna ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $users->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
@endsection
