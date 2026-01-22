@extends('layouts.student')

@section('title', 'Kelola Berkas - SMK SBI Portal PPDB')
@section('header_title', 'Kelola Berkas')
@section('header_subtitle', 'Kelola dokumen pendaftaran Anda')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="bg-sky-50 border border-sky-100 rounded-lg p-4 flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-5 h-5 text-sky-500 flex-shrink-0 mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
        </svg>
        <div class="text-sm text-sky-900">
            <span class="font-semibold block mb-0.5">Panduan Upload Berkas</span>
            <span class="text-sky-700">Pastikan file yang diunggah jelas dan dapat dibaca. Format yang diterima:
                JPG, JPEG, PNG, PDF. Maksimal ukuran file: 2MB.</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Daftar Berkas Pendaftaran</h3>
            <p class="text-sm text-slate-500">Status verifikasi berkas yang telah Anda unggah</p>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach($jenisBerkas as $jb)
                @php
                    $upload = $uploadedBerkas->firstWhere('jenis_berkas_id', $jb->id);
                    $isUploaded = !empty($upload);
                    $status = $isUploaded ? ($upload->status_verifikasi ?? 'pending') : 'missing';
                    $fileUrl = $isUploaded ? asset('storage/'.$upload->file_path) : '#';
                    $name = $jb->kode_berkas; // Used for ID
                    
                    // Status Badge Config
                    $statusConfig = [
                        'missing' => ['text' => 'Belum Diunggah', 'class' => 'bg-slate-100 text-slate-600', 'icon' => 'fa-circle'],
                        'pending' => ['text' => 'Menunggu Verifikasi', 'class' => 'bg-amber-100 text-amber-700', 'icon' => 'fa-clock'],
                        'verified' => ['text' => 'Terverifikasi', 'class' => 'bg-emerald-100 text-emerald-700', 'icon' => 'fa-check-circle'],
                        'rejected' => ['text' => 'Ditolak', 'class' => 'bg-rose-100 text-rose-700', 'icon' => 'fa-times-circle'],
                    ];
                    $currentStatus = $statusConfig[$status];
                    $canUpload = in_array($status, ['missing', 'rejected', 'pending']);
                @endphp

            <div class="p-6 hover:bg-slate-50 transition-colors flex flex-col gap-4" id="row-{{ $name }}">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $status == 'verified' ? 'bg-emerald-50 text-emerald-600' : ($status == 'rejected' ? 'bg-rose-50 text-rose-600' : 'bg-slate-100 text-slate-500') }}">
                             <i class="fa-solid fa-file-lines text-lg"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-medium text-slate-700">
                                    {{ $jb->nama_berkas }}
                                    @if($jb->is_wajib) <span class="text-rose-500">*</span> @endif
                                </h4>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium gap-1 {{ $currentStatus['class'] }}" id="badge-{{ $name }}">
                                    <i class="fa-solid {{ $currentStatus['icon'] }}"></i>
                                    <span id="status-text-{{ $name }}">{{ $currentStatus['text'] }}</span>
                                </span>
                            </div>
                            <p class="text-xs text-slate-500">
                                @if($isUploaded)
                                    <a href="{{ $fileUrl }}" target="_blank" class="hover:text-blue-600 underline decoration-dotted" id="link-{{ $name }}">Lihat File</a>
                                    • Diunggah: {{ $upload->uploaded_at ? $upload->uploaded_at->format('d M Y H:i') : '-' }}
                                @else
                                    <span class="italic text-slate-400">Belum ada file</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                         @if($isUploaded)
                            <a href="{{ $fileUrl }}" target="_blank" class="px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2 shadow-sm font-medium">
                                <i class="fa-solid fa-eye"></i> Lihat
                            </a>
                        @endif

                        @if($canUpload)
                            <div class="relative">
                                <input class="hidden file-input" type="file" id="{{ $name }}" name="{{ $name }}" data-type="{{ $name }}">
                                <label for="{{ $name }}" class="cursor-pointer px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2 shadow-sm font-medium">
                                    <i class="fa-solid fa-upload"></i> {{ $isUploaded ? 'Ganti File' : 'Upload File' }}
                                </label>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Rejection Note --}}
                @if($status == 'rejected' && !empty($upload->catatan_verifikasi))
                <div class="bg-rose-50 p-4 rounded-lg border border-rose-100 flex gap-3 text-sm text-rose-800">
                    <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                    <div>
                        <span class="font-bold block">Alasan Penolakan:</span>
                        {{ $upload->catatan_verifikasi }}
                    </div>
                </div>
                @endif
                
                {{-- Progress Bar --}}
                <div class="w-full bg-slate-200 rounded-full h-1.5 hidden" id="progress-container-{{ $name }}">
                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" style="width: 0%" id="progress-bar-{{ $name }}"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Stats Summary --}}
    @php
        $stats = [
            'verified' => $uploadedBerkas->where('status_verifikasi', 'verified')->count(),
            'pending' => $uploadedBerkas->where(function($q) { return $q->status_verifikasi == 'pending' || $q->status_verifikasi == null; })->count(),
            'rejected' => $uploadedBerkas->where('status_verifikasi', 'rejected')->count(),
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col items-center justify-center text-center">
            <div class="w-10 h-10 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-500 mb-3">
                <i class="fa-solid fa-check text-lg"></i>
            </div>
            <div class="text-3xl font-bold text-slate-800">{{ $stats['verified'] }}</div>
            <div class="text-xs text-slate-500 mt-1">Terverifikasi</div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col items-center justify-center text-center">
            <div class="w-10 h-10 bg-amber-50 rounded-full flex items-center justify-center text-amber-500 mb-3">
                 <i class="fa-solid fa-clock text-lg"></i>
            </div>
            <div class="text-3xl font-bold text-slate-800">{{ $stats['pending'] }}</div>
            <div class="text-xs text-slate-500 mt-1">Menunggu/Pending</div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col items-center justify-center text-center">
            <div class="w-10 h-10 bg-rose-50 rounded-full flex items-center justify-center text-rose-500 mb-3">
                 <i class="fa-solid fa-times text-lg"></i>
            </div>
            <div class="text-3xl font-bold text-slate-800">{{ $stats['rejected'] }}</div>
            <div class="text-xs text-slate-500 mt-1">Ditolak</div>
        </div>
    </div>
</div>

{{-- AJAX Upload Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.file-input');
        
        inputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const type = e.target.dataset.type; // kode_berkas
                if (!file) return;

                // UI Elements
                const progressBar = document.getElementById(`progress-bar-${type}`);
                const progressContainer = document.getElementById(`progress-container-${type}`);
                const badge = document.getElementById(`badge-${type}`);
                const statusText = document.getElementById(`status-text-${type}`);
                
                // Validation: File Size (Max 2MB) - CLIENT SIDE
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    e.target.value = '';
                    return;
                }

                // Show progress
                progressContainer.classList.remove('hidden');
                
                // Form Data
                const formData = new FormData();
                formData.append('file', file);
                formData.append('kode_berkas', type);
                formData.append('_token', '{{ csrf_token() }}');

                // AJAX Upload
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('pendaftaran.upload') }}', true);

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        progressBar.style.width = percentComplete + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if(response.success) {
                            // Update UI
                            statusText.innerText = 'Menunggu Verifikasi';
                            badge.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium gap-1 bg-amber-100 text-amber-700';
                            badge.innerHTML = '<i class="fa-solid fa-clock"></i> <span id="status-text-'+type+'">Menunggu Verifikasi</span>';
                            alert('Berkas berhasil diupload!');
                            location.reload(); // Reload to refresh timestamps and links
                        } else {
                            alert('Gagal mengupload file: ' + response.message);
                        }
                    } else {
                        alert('Terjadi kesalahan saat mengupload file.');
                    }
                    setTimeout(() => {
                        progressContainer.classList.add('hidden');
                        progressBar.style.width = '0%';
                    }, 1000);
                };

                xhr.onerror = function() {
                    alert('Error koneksi internet.');
                    progressContainer.classList.add('hidden');
                };

                xhr.send(formData);
            });
        });
    });
</script>
@endsection
