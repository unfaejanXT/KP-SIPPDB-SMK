@extends('layouts.admin')

@section('header_title', 'Data Pendaftar')
@section('header_subtitle', 'Kelola semua data calon siswa baru')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <div class="p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100">
            <form action="{{ route('admin.calon-siswa.index') }}" method="GET" class="flex w-full md:w-auto gap-2">
                <div class="relative w-full md:w-80">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </span>
                    <input type="text" name="q" id="searchInput" value="{{ request('q') }}" placeholder="Cari berdasarkan nama atau NISN..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
                </div>
                <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm font-medium hover:bg-slate-700 transition-colors shadow-sm">
                    Cari
                </button>
            </form>

            <div class="flex items-center gap-2">
                <div class="relative" id="filterDropdownContainer">
                    <button type="button" id="filterDropdownButton"
                        class="flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-filter text-gray-400"></i>
                        <span id="filterStatusText">{{ request('status') ? ucfirst(str_replace('_', ' ', request('status'))) : 'Semua Status' }}</span>
                        <i class="fa-solid fa-chevron-down text-xs ml-1 text-gray-400"></i>
                    </button>
                    <div id="filterDropdownMenu"
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                        <div class="py-1">
                            <a href="{{ route('admin.calon-siswa.index', array_merge(request()->except('status'), request()->only('q'))) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ !request('status') ? 'bg-gray-50 font-semibold' : '' }}">
                                <i class="fa-solid fa-list-ul text-gray-400 mr-2"></i> Semua Status
                            </a>
                            <a href="{{ route('admin.calon-siswa.index', array_merge(request()->except('status'), ['status' => 'draft'], request()->only('q'))) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ request('status') == 'draft' ? 'bg-gray-50 font-semibold' : '' }}">
                                <i class="fa-solid fa-file-pen text-gray-400 mr-2"></i> Draft
                            </a>
                            <a href="{{ route('admin.calon-siswa.index', array_merge(request()->except('status'), ['status' => 'menunggu_verifikasi'], request()->only('q'))) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ request('status') == 'menunggu_verifikasi' ? 'bg-gray-50 font-semibold' : '' }}">
                                <i class="fa-solid fa-clock text-amber-400 mr-2"></i> Menunggu Verifikasi
                            </a>
                            <a href="{{ route('admin.calon-siswa.index', array_merge(request()->except('status'), ['status' => 'terverifikasi'], request()->only('q'))) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ request('status') == 'terverifikasi' ? 'bg-gray-50 font-semibold' : '' }}">
                                <i class="fa-solid fa-check-circle text-emerald-400 mr-2"></i> Terverifikasi
                            </a>
                            <a href="{{ route('admin.calon-siswa.index', array_merge(request()->except('status'), ['status' => 'diterima'], request()->only('q'))) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ request('status') == 'diterima' ? 'bg-gray-50 font-semibold' : '' }}">
                                <i class="fa-solid fa-user-check text-emerald-400 mr-2"></i> Diterima
                            </a>
                            <a href="{{ route('admin.calon-siswa.index', array_merge(request()->except('status'), ['status' => 'ditolak'], request()->only('q'))) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ request('status') == 'ditolak' ? 'bg-gray-50 font-semibold' : '' }}">
                                <i class="fa-solid fa-times-circle text-red-400 mr-2"></i> Ditolak
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.calon-siswa.create') }}"
                    class="flex items-center gap-2 px-3 py-2 bg-slate-800 text-white rounded-lg text-sm font-medium hover:bg-slate-700 transition-colors shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                        <th class="px-6 py-4">Pendaftar</th>
                        <th class="px-6 py-4">NISN</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4">Gelombang</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pendaftarTableBody" class="divide-y divide-gray-100 transition-opacity duration-200">
                    @forelse($pendaftar as $s)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs border border-slate-200 uppercase">
                                    {{ substr($s->nama_lengkap ?? '??', 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">{{ $s->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-400">{{ $s->created_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                            {{ $s->nisn }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $s->nomor_hp }}</div>
                            <div class="text-xs text-gray-400">{{ $s->user->email ?? '-' }}</div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $s->jurusan->nama_jurusan ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $s->gelombang->nama_gelombang ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            @php
                                $status = strtolower($s->status);
                            @endphp
                            @if($status == 'terverifikasi' || $status == 'diterima')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 shadow-sm">
                                {{ ucfirst($s->status) }}
                            </span>
                            @elseif($status == 'menunggu' || $status == 'draft' || $status == 'menunggu_verifikasi')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 shadow-sm">
                                Menunggu
                            </span>
                            @elseif($status == 'ditolak')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700 shadow-sm">
                                Ditolak
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 shadow-sm">
                                {{ ucfirst($s->status) }}
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2 text-gray-400">
                                <a href="{{ route('admin.calon-siswa.show', $s->id) }}" class="p-1.5 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50"
                                    title="Lihat Detail">
                                    <i class="fa-regular fa-eye text-lg"></i>
                                </a>
                                <a href="{{ route('admin.calon-siswa.edit', $s->id) }}" class="p-1.5 hover:text-amber-600 transition-colors rounded-lg hover:bg-amber-50" title="Edit">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('admin.calon-siswa.destroy', $s->id) }}')" class="p-1.5 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Hapus">
                                    <i class="fa-regular fa-trash-can text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-regular fa-folder-open text-4xl text-gray-300 mb-2"></i>
                                <p>Belum ada data pendaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="paginationContainer" class="p-4 border-t border-gray-100">
            {{ $pendaftar->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/50 transition-opacity backdrop-blur-sm"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Hapus Data Calon Siswa</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus data calon siswa ini?
                                </p>
                                <div class="mt-3 rounded-md bg-red-50 p-3 border border-red-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fa-solid fa-circle-exclamation text-red-600 text-sm"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-800">
                                                PERINGATAN!
                                            </p>
                                            <p class="text-xs text-red-700 mt-1">
                                                Akun pengguna yang terkait juga akan <strong>DIHAPUS PERMANEN</strong> dan tidak dapat dipulihkan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-colors">
                            Ya, Hapus Permanen
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Live Search Logic
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('pendaftarTableBody');
    const paginationContainer = document.getElementById('paginationContainer');
    let debounceTimer;

    searchInput.addEventListener('input', function(e) {
        // Clear previous timer
        clearTimeout(debounceTimer);
        
        // Show loading state
        tableBody.style.opacity = '0.5';

        // Set debounce timer
        debounceTimer = setTimeout(() => {
            const query = e.target.value;
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('q', query);
            
            // Only update history, don't reload
            window.history.pushState({}, '', currentUrl);

            fetch(currentUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Update Table Body
                const newBody = doc.getElementById('pendaftarTableBody');
                if (newBody) {
                    tableBody.innerHTML = newBody.innerHTML;
                }
                
                // Update Pagination
                const newPagination = doc.getElementById('paginationContainer');
                if (newPagination && paginationContainer) {
                    paginationContainer.innerHTML = newPagination.innerHTML;
                }
            })
            .catch(error => {
                console.error('Search error:', error);
            })
            .finally(() => {
                // Restore opacity
                tableBody.style.opacity = '1';
            });
        }, 300); // 300ms delay
    });

    // Existing Delete Modal Logic
    function openDeleteModal(url) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this || e.target.querySelector('.backdrop-blur-sm') === e.target) {
           closeDeleteModal();
        }
    });

    // Dropdown Filter Logic
    const filterButton = document.getElementById('filterDropdownButton');
    const filterMenu = document.getElementById('filterDropdownMenu');
    const filterContainer = document.getElementById('filterDropdownContainer');

    if (filterButton && filterMenu) {
        filterButton.addEventListener('click', function(e) {
            e.stopPropagation();
            filterMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!filterContainer.contains(e.target)) {
                filterMenu.classList.add('hidden');
            }
        });
    }
</script>
@endpush
