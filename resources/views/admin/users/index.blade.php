@extends('layouts.admin')

@section('title', 'Kelola Akun Pengguna')
@section('header_title', 'Kelola Akun Pengguna')
@section('header_subtitle', 'Atur hak akses dan pengguna sistem')

@section('content')
<div x-data="{ 
    showModal: false, 
    showDeleteModal: false,
    isEdit: false, 
    formUrl: '', 
    deleteAction: '',
    deleteName: '',
    formData: {
        name: '',
        email: '',
        password: '',
        role: ''
    },
    openAddModal() {
        this.isEdit = false;
        this.formUrl = '{{ route('admin.users.store') }}';
        this.formData = {
            name: '',
            email: '',
            password: '',
            role: ''
        };
        this.showModal = true;
    },
    openEditModal(user) {
        this.isEdit = true;
        this.formUrl = '{{ route('admin.users.update', ':id') }}'.replace(':id', user.id);
        // Safely access role if exists
        let roleName = '';
        if (user.roles && user.roles.length > 0) {
            roleName = user.roles[0].name;
        }
        
        this.formData = {
            name: user.name,
            email: user.email,
            password: '',
            role: roleName
        };
        this.showModal = true;
    },
    confirmDelete(actionUrl, name) {
        this.deleteAction = actionUrl;
        this.deleteName = name;
        this.showDeleteModal = true;
    },
    closeModal() {
        this.showModal = false;
        this.showDeleteModal = false;
    }
}">

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
        
        @if ($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
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
                    <div class="text-2xl font-bold text-slate-800">{{ $totalActive }}</div>
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
                                @foreach($filterRoles as $role)
                                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                             <i class="fa-solid fa-chevron-down text-slate-400 absolute right-2 top-3 text-xs pointer-events-none"></i>
                        </div>
                    </form>

                    <button @click="openAddModal()"
                        class="bg-[#0f172a] hover:bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                        <i class="fa-solid fa-plus text-sm"></i>
                        Tambah Pengguna
                    </button>
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
                            <th class="px-6 py-4">Terakhir Aktif</th>
                            <th class="px-6 py-4">Terdaftar</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-xs font-bold uppercase relative">
                                        {{ substr($user->name, 0, 2) }}
                                        @if($user->isOnline())
                                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full" title="Sedang Online"></span>
                                        @endif
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
                                @if($user->is_active)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-600 border border-green-200">Aktif</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                                @if($user->last_login_at)
                                    <div class="text-sm text-slate-800">{{ $user->last_login_at->diffForHumans() }}</div>
                                    <div class="text-xs text-slate-400">{{ $user->last_login_at->format('d M H:i') }}</div>
                                    @if($user->last_login_ip)
                                        <div class="text-[10px] text-slate-300">{{ $user->last_login_ip }}</div>
                                    @endif
                                @else
                                    <span class="text-xs text-slate-400 italic">Belum login</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                                {{ $user->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors {{ $user->is_active ? 'text-green-600' : 'text-slate-400' }}" title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fa-solid fa-power-off"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <button @click='openEditModal(@json($user))' class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 hover:text-blue-600 transition-colors" title="Edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    
                                    @if(auth()->id() !== $user->id)
                                    <button @click="confirmDelete('{{ route('admin.users.destroy', $user->id) }}', '{{ $user->name }}')" 
                                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
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

    <!-- Modal Form (Input/Edit) -->
    <div x-show="showModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="showModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                @click="closeModal()" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div x-show="showModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <form :action="formUrl" method="POST">
                    @csrf
                    <!-- Add PUT method if editing -->
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 border-b pb-2 mb-4" id="modal-title" x-text="isEdit ? 'Edit Pengguna' : 'Tambah Pengguna'"></h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="name" id="name" x-model="formData.name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" x-model="formData.email" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password <span x-show="isEdit" class="text-xs text-slate-500 font-normal">(Biarkan kosong jika tidak diubah)</span></label>
                                <input type="password" name="password" id="password" x-model="formData.password" :required="!isEdit" minlength="8"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                <p class="text-xs text-slate-500 mt-1" x-show="!isEdit">Minimal 8 karakter</p>
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select name="role" id="role" x-model="formData.role" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2">
                                    <option value="">Pilih Role</option>
                                    @foreach($allRoles as $role)
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" @click="closeModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Critical -->
    <div x-show="showDeleteModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="showDeleteModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-red-900 bg-opacity-20 transition-opacity backdrop-blur-sm" 
                @click="closeModal()" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div x-show="showDeleteModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border-t-4 border-red-500">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Data Pengguna</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus pengguna <span class="font-bold text-gray-800" x-text="deleteName"></span>? 
                                    Tindakan ini tidak dapat dibatalkan dan semua data terkait akan hilang permanen.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form :action="deleteAction" method="POST" class="w-full sm:w-auto sm:ml-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                            Ya, Hapus Permanen
                        </button>
                    </form>
                    <button type="button" @click="closeModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

