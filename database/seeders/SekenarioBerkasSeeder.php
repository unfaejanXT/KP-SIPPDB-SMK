<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berkas;
use App\Models\JenisBerkas;
use Carbon\Carbon;

class SekenarioBerkasSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan semua berkas
        $berkasAll = Berkas::with('jenisBerkas')->get();

        // Memeriksa dan memperbarui setiap berkas
        foreach ($berkasAll as $berkas) {
            $kode = $berkas->jenisBerkas->kode_berkas ?? '';

            if ($kode === 'ijazah') {
                // Menolak berkas ijazah
                $berkas->update([
                    'status_verifikasi' => 'ditolak', // Status menjadi ditolak
                    'catatan_verifikasi' => 'Berkas ijazah masih tidak memenuhi syarat', // Alasan penolakan
                    'verified_at' => Carbon::now(), // Mengisi tanggal verifikasi dengan tanggal saat ini
                ]);

                // Output untuk berkas ijazah yang ditolak
                $this->command->info('Berkas ijazah dengan ID: ' . $berkas->id . ' ditolak kembali.');
            } else {
                // Menyetujui berkas lainnya
                $berkas->update([
                    'status_verifikasi' => 'verified', // Status menjadi verified
                    'catatan_verifikasi' => 'Berkas memenuhi syarat', // Catatan persetujuan
                    'verified_at' => Carbon::now() // Mengisi tanggal verifikasi dengan tanggal saat ini
                ]);

                // Output untuk berkas yang disetujui
                $this->command->info('Berkas dengan ID: ' . $berkas->id . ' telah disetujui.');
            }
        }

        // User mengirim ulang berkas ijazah yang ditolak
        // Find by joining jenis_berkas
        $berkasIjazahDitolak = Berkas::whereHas('jenisBerkas', function($q) {
                $q->where('kode_berkas', 'ijazah');
            })
            ->where('status_verifikasi', 'ditolak')
            ->first();

        if ($berkasIjazahDitolak) {
            Berkas::create([
                'pendaftaran_id' => $berkasIjazahDitolak->pendaftaran_id,
                'jenis_berkas_id' => $berkasIjazahDitolak->jenis_berkas_id,
                'file_path' => $berkasIjazahDitolak->file_path,
                'status_verifikasi' => null,
                'catatan_verifikasi' => null,
                'verified_at' => null,
                'uploaded_at' => now(), // New upload time
            ]);

            // Output sukses
            $this->command->info('Berkas ijazah baru telah dikirim ulang.');
            
            // Mendapatkan berkas ijazah yang terakhir dikirim ulang
            // Assuming the one with null status is the new one
            $berkasIjazahDikirimUlang = Berkas::whereHas('jenisBerkas', function($q) {
                    $q->where('kode_berkas', 'ijazah');
                })
                ->whereNull('status_verifikasi')
                ->latest('uploaded_at')
                ->first();

            if ($berkasIjazahDikirimUlang) {
                // Menyetujui berkas ijazah yang dikirim ulang
                $berkasIjazahDikirimUlang->update([
                    'status_verifikasi' => 'verified',
                    'catatan_verifikasi' => 'Berkas ijazah telah memenuhi syarat',
                    'verified_at' => Carbon::now()
                ]);

                // Output sukses
                $this->command->info('Berkas ijazah dengan ID: ' . $berkasIjazahDikirimUlang->id . ' telah disetujui.');
            } else {
                $this->command->error('Tidak ada berkas ijazah yang perlu disetujui.');
            }
        }
    }
}
