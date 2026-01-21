<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\OrangTuaSiswa;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\User; // Asumsi ada model User untuk menghubungkan pendaftaran dengan user

class PendaftaranSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan periode PPDB (Gelombang) yang aktif
        $periodePPDB = Gelombang::where('is_active', true)->first();

        // Mendapatkan jurusan Agribisnis yang memiliki id = 1
        $jurusanAgribisnis = Jurusan::find(1);

        // Cek apakah periode PPDB dan jurusan Agribisnis ada
        if ($periodePPDB && $jurusanAgribisnis) {
            // Membuat user dummy, jika belum ada user untuk pendaftaran (atau bisa disesuaikan)
            $user = User::create([
                'username' => '1234567891',
                'nohp' => '081320427434',
                'password' => bcrypt('password123'), // pastikan untuk enkripsi password
            ])->assignRole('admin');

            // Membuat data pendaftaran untuk siswa
            $pendaftaran = Pendaftaran::create([
                'nisn' => '1234567890',
                'nama_lengkap' => 'Jane Smith',
                'jenis_kelamin' => 'P', // Perempuan
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2005-03-21',
                'golongan_darah' => 'O',
                'agama' => 'Islam',
                'alamat_rumah' => 'Jl. Merdeka No. 45, Bandung',
                'nomor_hp' => '081234567890',
                'asal_sekolah' => 'SDN 1 Bandung',
                'pas_foto' => 'contohfoto.png',
                'user_id' => $user->id, // Asosiasi dengan user
                'gelombang_id' => $periodePPDB->id, // Menghubungkan dengan periode PPDB yang aktif
                'jurusan_id' => $jurusanAgribisnis->id, // Menghubungkan dengan jurusan Agribisnis
            ]);

            // Menambahkan data orangtua siswa
            OrangTuaSiswa::create([
                'pendaftaran_id' => $pendaftaran->id,
                'nama_ayah' => 'Budi Santoso',
                'pekerjaan_ayah' => 'Petani',
                'penghasilan_ayah' => 3000000,
                'nama_ibu' => 'Siti Aisyah',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => 0,
                'nama_wali' => 'Ahmad Junaedi',
                'pekerjaan_wali' => 'PNS',
                'penghasilan_wali' => 4000000,
                'alamat_wali' => 'Jl. Raya No. 25, Bandung',
                'no_hp_wali' => '08123456789',
                'no_hp_orangtua' => '08567890123',
            ]);

            // Output sukses
            $this->command->info('Data pendaftaran siswa berhasil ditambahkan!');
        } else {
            // Jika periode PPDB atau jurusan tidak ditemukan
            $this->command->error('Periode PPDB aktif atau jurusan Agribisnis tidak ditemukan!');
        }
    }
}
