<?php

namespace Database\Seeders;

use App\Models\berkas;
use App\Models\orangtua;
use App\Models\pendaftaransiswa;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentsRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array data agama untuk random
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        
        // Array golongan darah untuk random
        $golDarah = ['A', 'B', 'O', 'AB'];
        
        // Array pekerjaan untuk random
        $pekerjaan = ['PNS', 'Wiraswasta', 'Karyawan Swasta', 'TNI/Polri', 'Petani', 'Pedagang'];

        // Loop untuk membuat 10 data pendaftaran
        for($i = 1; $i <= 10; $i++) {
            // Buat document terlebih dahulu
            $document = berkas::create([
                'foto' => 'foto_' . $i . '.jpg',
                'kk' => 'kk_' . $i . '.pdf',
                'akta_kelahiran' => 'akta_' . $i . '.pdf',
                'ijazah' => 'ijazah_' . $i . '.pdf',
            ]);

            // Buat data parent
            $parent = orangtua::create([
                'nama_ayah' => 'Ayah Siswa ' . $i,
                'pekerjaan_ayah' => $pekerjaan[array_rand($pekerjaan)],
                'nama_ibu' => 'Ibu Siswa ' . $i,
                'pekerjaan_ibu' => $pekerjaan[array_rand($pekerjaan)],
                'nohp_orangtua' => '08' . rand(1000000000, 9999999999),
                'nama_wali' => rand(0, 1) ? 'Wali Siswa ' . $i : null,
                'pekerjaan_wali' => rand(0, 1) ? $pekerjaan[array_rand($pekerjaan)] : null,
                'nohp_wali' => rand(0, 1) ? '08' . rand(1000000000, 9999999999) : null,
            ]);

            // Generate NISN unik 10 digit
            $nisn = str_pad($i, 10, '0', STR_PAD_LEFT);

            // Buat tanggal lahir random antara 15-17 tahun yang lalu
            $tahunLahir = rand(2007, 2009);
            $bulanLahir = rand(1, 12);
            $tanggalLahir = rand(1, 28);
            
            // Buat data student registration
            pendaftaransiswa::create([
                'nisn' => $nisn,
                'nama_lengkap' => 'Siswa Test ' . $i,
                'jenis_kelamin' => rand(0, 1) ? 'L' : 'P',
                'tempat_lahir' => 'Kota Lahir ' . $i,
                'tanggal_lahir' => Carbon::create($tahunLahir, $bulanLahir, $tanggalLahir),
                'gol_darah' => $golDarah[array_rand($golDarah)],
                'agama' => $agama[array_rand($agama)],
                'alamat' => 'Jl. Siswa No. ' . $i . ', Kota Test',
                'nohp' => '08' . rand(1000000000, 9999999999),
                'asal_sekolah' => 'SMP ' . $i . ' Kota Test',
                'tanggal_daftar' => Carbon::now(),
                'orangtua_id' => $parent->id,
                'berkas_id' => $document->id,
            ]);
        }
    }
}