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

    // Validasi untuk data orangtua siswa
    public static function rules()
    {
        return [
            'pendaftaran_id' => 'required|exists:pendaftaran,id|unique:orangtuasiswa,pendaftaran_id',
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric|min:0',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric|min:0',
            'nama_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:50',
            'penghasilan_wali' => 'nullable|numeric|min:0',
            'alamat_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:20',
            'no_hp_orangtua' => 'required|string|max:20',
        ];
    }

    // Accessor untuk format nama lengkap orang tua
    public function getNamaOrangtuaFormattedAttribute()
    {
        return $this->nama_ayah . ' & ' . $this->nama_ibu;
    }
}
