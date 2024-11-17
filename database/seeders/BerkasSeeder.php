<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\Berkas;

class BerkasSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan pendaftaran siswa yang terakhir didaftarkan
        $pendaftaran = Pendaftaran::latest()->first();

        // Cek jika ada pendaftaran siswa
        if ($pendaftaran) {
            // Membuat data berkas untuk pendaftaran tersebut
            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id, // Menghubungkan ke pendaftaran
                'tipe_berkas' => 'kk',
                'path_berkas' => 'uploads/berkas/kk_' . $pendaftaran->nisn . '.pdf', // Path file berkas
                'status_verifikasi' => null, // Status verifikasi belum ada
                'catatan_verifikasi' => null, // Catatan verifikasi jika ada
                'tanggal_verifikasi' => null, // Belum diverifikasi
                'is_active' => true // Berkas aktif
            ]);

            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id, // Menghubungkan ke pendaftaran
                'tipe_berkas' => 'ijazah',
                'path_berkas' => 'uploads/berkas/ijazah_' . $pendaftaran->nisn . '.pdf', // Path file berkas
                'status_verifikasi' => null, // Status verifikasi belum ada
                'catatan_verifikasi' => null, // Catatan verifikasi jika ada
                'tanggal_verifikasi' => null, // Belum diverifikasi
                'is_active' => true // Berkas aktif
            ]);

            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id, // Menghubungkan ke pendaftaran
                'tipe_berkas' => 'akta_kelahiran',
                'path_berkas' => 'uploads/berkas/akta_kelahiran_' . $pendaftaran->nisn . '.pdf', // Path file berkas
                'status_verifikasi' => null, // Status verifikasi belum ada
                'catatan_verifikasi' => null, // Catatan verifikasi jika ada
                'tanggal_verifikasi' => null, // Belum diverifikasi
                'is_active' => true // Berkas aktif
            ]);

            // Menambahkan berkas KTP Orang Tua
            Berkas::create([
                'pendaftaran_id' => $pendaftaran->id, // Menghubungkan ke pendaftaran
                'tipe_berkas' => 'ktp_orangtua',
                'path_berkas' => 'uploads/berkas/ktp_orangtua_' . $pendaftaran->nisn . '.pdf', // Path file berkas
                'status_verifikasi' => null, // Status verifikasi belum ada
                'catatan_verifikasi' => null, // Catatan verifikasi jika ada
                'tanggal_verifikasi' => null, // Belum diverifikasi
                'is_active' => true // Berkas aktif
            ]);

            // Output sukses
            $this->command->info('Berkas berhasil diupload untuk pendaftaran dengan NISN: ' . $pendaftaran->nisn);
        } else {
            // Jika tidak ada pendaftaran ditemukan
            $this->command->error('Tidak ada data pendaftaran yang ditemukan untuk berkas!');
        }
    }
}
