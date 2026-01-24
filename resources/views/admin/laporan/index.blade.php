@extends('layouts.admin')

@section('title', 'Laporan PPDB - Admin Dashboard')
@section('header_title', 'Laporan PPDB')
@section('header_subtitle', 'Rekap dan export data PPDB')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="font-bold text-slate-800 text-lg">Filter Data Laporan</h3>
            
            <form action="{{ route('admin.laporan.export') }}" method="GET" class="flex gap-2">
                <!-- Hidden inputs to pass filter current values to export -->
                <input type="hidden" name="jurusan_id" value="{{ request('jurusan_id') }}">
                <input type="hidden" name="gelombang_id" value="{{ request('gelombang_id') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">
                
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Excel
                </button>
            </form>
        </div>
        
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1.5 uppercase tracking-wide">Jurusan</label>
                <select name="jurusan_id" class="w-full bg-white border border-gray-200 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1.5 uppercase tracking-wide">Gelombang</label>
                <select name="gelombang_id" class="w-full bg-white border border-gray-200 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    <option value="">Semua Gelombang</option>
                    @foreach($gelombangs as $gelombang)
                    <option value="{{ $gelombang->id }}" {{ request('gelombang_id') == $gelombang->id ? 'selected' : '' }}>{{ $gelombang->nama_gelombang }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1.5 uppercase tracking-wide">Status</label>
                <select name="status" class="w-full bg-white border border-gray-200 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-filter"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">No. Pendaftaran</th>
                    <th scope="col" class="px-6 py-4">Nama Siswa</th>
                    <th scope="col" class="px-6 py-4">Asal Sekolah</th>
                    <th scope="col" class="px-6 py-4">Jurusan</th>
                    <th scope="col" class="px-6 py-4">Gelombang</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftarans as $siswa)
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-900">
                        {{ $siswa->no_pendaftaran ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ $siswa->nama_lengkap }}</div>
                        <div class="text-xs text-slate-500 mt-0.5">{{ $siswa->nisn }}</div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $siswa->asal_sekolah }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 py-1 px-2.5 rounded text-xs font-medium">
                            {{ $siswa->jurusan->nama_jurusan }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $siswa->gelombang->nama_gelombang }}
                    </td>
                     <td class="px-6 py-4">
                        @if($siswa->status == 'terverifikasi')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Terverifikasi
                            </span>
                        @elseif($siswa->status == 'submitted')
                             <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                Menunggu Verifikasi
                            </span>
                        @else
                             <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $siswa->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <i class="fa-regular fa-folder-open text-3xl mb-2 opacity-50"></i>
                            <p>Tidak ada data siswa ditemukan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pendaftarans->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $pendaftarans->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection
