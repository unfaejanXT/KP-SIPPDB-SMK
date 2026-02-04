<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrangTuaSiswa extends Model
{
    use HasFactory;

    protected $table = 'orangtuasiswa';

    protected $fillable = [
        'pendaftaran_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'alamat_wali',
        'no_hp_wali',
        'no_hp_orangtua',
    ];

    // Relasi ke tabel 'pendaftaran' (setiap orangtua siswa memiliki satu pendaftaran)
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class); // Menghubungkan ke model Pendaftaran
    }



    // Accessor untuk format nama lengkap orang tua
    public function getNamaOrangtuaFormattedAttribute()
    {
        return $this->nama_ayah . ' & ' . $this->nama_ibu;
    }
}
