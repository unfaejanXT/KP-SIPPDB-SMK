<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Exports\RekapPPDBExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        $jurusans = Jurusan::all();
        $gelombangs = Gelombang::all();

        $query = Pendaftaran::with(['orangTua', 'gelombang', 'jurusan']);

        if ($request->has('jurusan_id') && $request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        if ($request->has('gelombang_id') && $request->gelombang_id) {
            $query->where('gelombang_id', $request->gelombang_id);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pendaftarans = $query->latest()->paginate(10);

        return view('admin.laporan.index', compact('pendaftarans', 'jurusans', 'gelombangs'));
    }

    public function export(Request $request) 
    {
        $filters = [
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
            'status' => $request->status,
        ];

        return Excel::download(new RekapPPDBExport($filters), 'laporan-ppdb-' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }
}
