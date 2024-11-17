<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berkas;
use Carbon\Carbon;

class SekenarioBerkasSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan semua berkas yang aktif
        $berkasAktif = Berkas::where('is_active', true)->get();

        // Memeriksa dan memperbarui setiap berkas
        foreach ($berkasAktif as $berkas) {
            if ($berkas->tipe_berkas === 'ijazah') {
                // Menolak berkas ijazah
                $berkas->update([
                    'status_verifikasi' => 'ditolak', // Status menjadi ditolak
                    'catatan_verifikasi' => 'Berkas ijazah masih tidak memenuhi syarat', // Alasan penolakan
                    'tanggal_verifikasi' => Carbon::now(), // Mengisi tanggal verifikasi dengan tanggal saat ini
                    'is_active' => false // Mengubah is_active menjadi false
                ]);

                // Output untuk berkas ijazah yang ditolak
                $this->command->info('Berkas ijazah dengan ID: ' . $berkas->id . ' ditolak kembali.');
            } else {
                // Menyetujui berkas lainnya
                $berkas->update([
                    'status_verifikasi' => 'disetujui', // Status menjadi disetujui
                    'catatan_verifikasi' => 'Berkas memenuhi syarat', // Catatan persetujuan
                    'tanggal_verifikasi' => Carbon::now() // Mengisi tanggal verifikasi dengan tanggal saat ini
                ]);

                // Output untuk berkas yang disetujui
                $this->command->info('Berkas dengan ID: ' . $berkas->id . ' telah disetujui.');
            }
        }

        // User mengirim ulang berkas ijazah yang ditolak
        $berkasIjazahDitolak = Berkas::where('tipe_berkas', 'ijazah')
            ->where('status_verifikasi', 'ditolak')
            ->first();

        if ($berkasIjazahDitolak) {
            Berkas::create([
                'pendaftaran_id' => $berkasIjazahDitolak->pendaftaran_id, // Menghubungkan ke pendaftaran yang sama
                'tipe_berkas' => $berkasIjazahDitolak->tipe_berkas, // Tipe berkas yang sama
                'path_berkas' => $berkasIjazahDitolak->path_berkas, // Path file berkas yang sama
                'status_verifikasi' => null, // Status verifikasi diatur ulang
                'catatan_verifikasi' => null, // Catatan verifikasi diatur ulang
                'tanggal_verifikasi' => null, // Tanggal verifikasi diatur ulang
                'is_active' => true // Berkas baru diaktifkan
            ]);

            // Output sukses untuk berkas ijazah yang dikirim ulang
            $this->command->info('Berkas ijazah baru telah dikirim ulang.');
            // Mendapatkan berkas ijazah yang terakhir dikirim ulang
            $berkasIjazahDikirimUlang = Berkas::where('tipe_berkas', 'ijazah')
                ->where('is_active', true)
                ->whereNull('status_verifikasi')
                ->first();

            if ($berkasIjazahDikirimUlang) {
                // Menyetujui berkas ijazah yang dikirim ulang
                $berkasIjazahDikirimUlang->update([
                    'status_verifikasi' => 'disetujui', // Mengubah status menjadi disetujui
                    'catatan_verifikasi' => 'Berkas ijazah telah memenuhi syarat', // Catatan persetujuan
                    'tanggal_verifikasi' => Carbon::now() // Mengisi tanggal verifikasi dengan tanggal saat ini
                ]);

                // Output sukses untuk berkas ijazah yang disetujui
                $this->command->info('Berkas ijazah dengan ID: ' . $berkasIjazahDikirimUlang->id . ' telah disetujui.');
            } else {
                // Jika tidak ada berkas ijazah yang ditemukan
                $this->command->error('Tidak ada berkas ijazah yang perlu disetujui.');
            }
        }
    }
}
