<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use App\Models\OrangTuaSiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class RekapPPDBExport implements FromView, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = Pendaftaran::with(['orangTua', 'gelombang', 'jurusan']);

        if (!empty($this->filters['jurusan_id'])) {
            $query->where('jurusan_id', $this->filters['jurusan_id']);
        }

        if (!empty($this->filters['gelombang_id'])) {
            $query->where('gelombang_id', $this->filters['gelombang_id']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        $pendaftaranData = $query->get();

        return view('admin.laporan.export_excel', [
            'pendaftaranData' => $pendaftaranData
        ]);
    }
}
