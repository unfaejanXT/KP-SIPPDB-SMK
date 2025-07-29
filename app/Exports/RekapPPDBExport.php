<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use App\Models\OrangTuaSiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RekapPPDBExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        // Fetch data from the database
        $pendaftaranData = Pendaftaran::with(['orangTuaSiswa', 'periodePPDB', 'jurusan'])->get();

        return view('adminpanel.rekap.exports.rekap_ppdb', [
            'pendaftaranData' => $pendaftaranData
        ]);
    }
}
