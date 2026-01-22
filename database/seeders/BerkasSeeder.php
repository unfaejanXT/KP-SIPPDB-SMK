<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\Berkas;
use App\Models\JenisBerkas;

class BerkasSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan pendaftaran siswa yang terakhir didaftarkan
        $pendaftaran = Pendaftaran::latest()->first();

        // Cek jika ada pendaftaran siswa
        if ($pendaftaran) {
            
            // Helper to get ID by code
            $getJenisId = function($code) {
                return JenisBerkas::where('kode_berkas', $code)->value('id');
            };

            // Membuat data berkas untuk pendaftaran tersebut
            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id, 
                'jenis_berkas_id' => $getJenisId('kk'),
                'file_path' => 'uploads/berkas/kk_' . $pendaftaran->nisn . '.pdf',
                'status_verifikasi' => null,
                'catatan_verifikasi' => null,
                'verified_at' => null,
                'uploaded_at' => now(),
            ]);

            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis_berkas_id' => $getJenisId('ijazah'),
                'file_path' => 'uploads/berkas/ijazah_' . $pendaftaran->nisn . '.pdf',
                'status_verifikasi' => null,
                'catatan_verifikasi' => null,
                'verified_at' => null,
                'uploaded_at' => now(),
            ]);

            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis_berkas_id' => $getJenisId('akta_kelahiran'),
                'file_path' => 'uploads/berkas/akta_kelahiran_' . $pendaftaran->nisn . '.pdf',
                'status_verifikasi' => null,
                'catatan_verifikasi' => null,
                'verified_at' => null,
                'uploaded_at' => now(),
            ]);

            // Menambahkan berkas KTP Orang Tua
            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis_berkas_id' => $getJenisId('ktp_orangtua'),
                'file_path' => 'uploads/berkas/ktp_orangtua_' . $pendaftaran->nisn . '.pdf',
                'status_verifikasi' => null,
                'catatan_verifikasi' => null,
                'verified_at' => null,
                'uploaded_at' => now(),
            ]);

            // Output sukses
            $this->command->info('Berkas berhasil diupload untuk pendaftaran dengan NISN: ' . $pendaftaran->nisn);
        } else {
            // Jika tidak ada pendaftaran ditemukan
            $this->command->error('Tidak ada data pendaftaran yang ditemukan untuk berkas!');
        }
    }
}
