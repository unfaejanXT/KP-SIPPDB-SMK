@extends('layouts.admin')

@section('header_title', 'Data Pendaftar')
@section('header_subtitle', 'Kelola semua data calon siswa baru')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <div class="p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100">
            <div class="relative w-full md:w-96">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" placeholder="Cari berdasarkan nama atau NISN..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400">
            </div>

            <div class="flex items-center gap-2">
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                    <i class="fa-solid fa-filter text-gray-400"></i>
                    <span>Semua Status</span>
                    <i class="fa-solid fa-chevron-down text-xs ml-1 text-gray-400"></i>
                </button>
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                    <i class="fa-solid fa-download text-gray-400"></i>
                    <span>Ekspor</span>
                </button>
                <a href="{{ route('admin.calon-siswa.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-lg text-sm font-medium hover:bg-slate-700 shadow-sm transition-colors">
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
                <tbody class="divide-y divide-gray-100">
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
                            {{ $s->periodePPDB->nama_gelombang ?? '-' }}
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
                                <button class="p-1.5 hover:text-slate-800 transition-colors rounded-lg hover:bg-slate-100">
                                    <i class="fa-solid fa-ellipsis text-lg"></i>
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

        <div class="p-4 border-t border-gray-100">
            {{ $pendaftar->links() }}
        </div>
    </div>
@endsection
