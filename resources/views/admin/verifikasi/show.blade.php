@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - ' . $pendaftaran->nama_lengkap)
@section('header_title', 'Verifikasi Berkas')
@section('header_subtitle', 'Detail berkas: ' . $pendaftaran->nama_lengkap)

@section('content')
<div class="space-y-6">
    <!-- Back Button for Mobile -->
    <div class="lg:hidden">
        <a href="{{ route('admin.verifikasi.index') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Content Split Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-10">
        <!-- List of Pendaftar (Hidden on mobile if desired, or just smaller) -->
        <div class="lg:col-span-4 space-y-4 hidden lg:block">
            <a href="{{ route('admin.verifikasi.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 font-semibold text-sm mb-4 transition-colors">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
            
            <div class="bg-white rounded-2xl border-2 border-blue-500 ring-4 ring-blue-50/50 shadow-sm p-5 relative overflow-hidden transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-lg shrink-0">
                        {{ substr($pendaftaran->nama_lengkap, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-base leading-tight">{{ $pendaftaran->nama_lengkap }}</h3>
                        <p class="text-xs text-slate-500 mt-1">NISN: {{ $pendaftaran->nisn }}</p>
                        <p class="text-xs text-slate-500">{{ $pendaftaran->jurusan->nama_jurusan ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail of Berkas -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden sticky top-24">
                <div class="p-6 border-b border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Detail Berkas Pendaftaran</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Kelola verifikasi setiap dokumen</p>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('admin.verifikasi.verifyAll', $pendaftaran) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-500 text-white text-sm font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-200 flex items-center gap-2 transition-all active:scale-95">
                                <i class="fa-solid fa-check-double"></i> Verifikasi Semua
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    @forelse($pendaftaran->berkas as $berkas)
                    <div class="p-5 border border-gray-100 rounded-2xl bg-slate-50/30 flex flex-col md:flex-row items-center justify-between gap-4 group hover:border-blue-200 hover:bg-white transition-all">
                        <div class="flex items-center gap-4 w-full md:w-auto">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-slate-400 border border-gray-100 shadow-sm group-hover:text-blue-500 transition-colors">
                                @if(in_array(pathinfo($berkas->path_berkas, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                    <i class="fa-solid fa-file-image text-xl"></i>
                                @else
                                    <i class="fa-solid fa-file-pdf text-xl"></i>
                                @endif
                            </div>
                            <div>
                                <div class="text-base font-bold text-slate-700">{{ $berkas->jenisBerkas->nama_berkas }}</div>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400">{{ pathinfo($berkas->file_path, PATHINFO_EXTENSION) ?: 'File' }} Document</span>
                                    <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                    <a href="{{ asset('storage/' . $berkas->file_path) }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:underline">Lihat Dokumen <i class="fa-solid fa-external-link text-[10px]"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'verified' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'rejected' => 'bg-rose-100 text-rose-700 border-rose-200',
                                ];
                                $status = $berkas->status_verifikasi ?? 'pending';
                            @endphp
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold border {{ $statusClasses[$status] }}">
                                {{ ucfirst($status) }}
                            </span>

                            <div class="flex gap-2">
                                <form action="{{ route('admin.verifikasi.updateStatus', $berkas) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" title="Verifikasi" class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-emerald-500 hover:bg-emerald-50 hover:border-emerald-200 bg-white shadow-sm transition-all active:scale-90">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                <button onclick="openRejectModal('{{ $berkas->id }}', '{{ $berkas->jenisBerkas->nama_berkas }}')" title="Tolak" class="w-9 h-9 rounded-xl border border-gray-100 flex items-center justify-center text-rose-500 hover:bg-rose-50 hover:border-rose-200 bg-white shadow-sm transition-all active:scale-90">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                        @if($berkas->catatan_verifikasi)
                        <div class="mt-2 ml-16 flex items-start gap-2 text-rose-600 bg-rose-50 p-3 rounded-lg border border-rose-100 text-xs">
                           <i class="fa-solid fa-circle-info mt-0.5"></i>
                           <div>
                               <span class="font-bold">Catatan Penolakan:</span> {{ $berkas->catatan_verifikasi }}
                           </div>
                        </div>
                        @endif
                    @empty
                    <div class="text-center py-10">
                        <i class="fa-solid fa-file-circle-exclamation text-4xl text-slate-200 mb-3"></i>
                        <p class="text-slate-500">Belum ada berkas yang diunggah</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden relative transform transition-all scale-100">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Tolak Berkas</h3>
                <button onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form id="rejectForm" method="POST" action="">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-sm text-slate-500">Berikan alasan penolakan untuk berkas <span id="targetBerkasName" class="font-bold text-slate-700"></span>. Catatan ini akan terlihat oleh siswa.</p>
                    <input type="hidden" name="status" value="rejected">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Alasan Penolakan</label>
                        <textarea name="catatan" rows="3" required class="w-full px-4 py-3 bg-slate-50 border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none resize-none" placeholder="Contoh: Dokumen tidak terbaca atau tidak sesuai..."></textarea>
                    </div>
                </div>
                <div class="p-6 bg-slate-50 flex gap-3">
                    <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-rose-500 text-white text-sm font-bold hover:bg-rose-600 shadow-lg shadow-rose-200 transition-all active:scale-95">Tolak Berkas</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openRejectModal(berkasId, berkasName) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        const nameSpan = document.getElementById('targetBerkasName');
        
        form.action = `/admin/verifikasi-berkas/${berkasId}/status`;
        nameSpan.innerText = berkasName;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush
@endsection
