<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'berkas';

    // Menentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'tipe_berkas',
        'path_berkas',
        'status_verifikasi',
        'catatan_verifikasi',
        'tanggal_verifikasi',
        'is_active',
        'pendaftaran_id',
    ];

    // Menentukan kolom-kolom yang akan diproses oleh Laravel
    protected $casts = [
        'tanggal_verifikasi' => 'date',
        'is_active' => 'boolean',
    ];

    // Relasi dengan Pendaftaran (menggunakan method belongsTo)
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    // Scope untuk mendapatkan berkas yang aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mendapatkan berkas yang sudah terverifikasi
    public function scopeTerverifikasi($query)
    {
        return $query->whereNotNull('tanggal_verifikasi')
                    ->where('status_verifikasi', 'verified');
    }

    // Method untuk melakukan verifikasi berkas
    public function verifikasi($status, $catatan = null)
    {
        $this->update([
            'status_verifikasi' => $status,
            'catatan_verifikasi' => $catatan,
            'tanggal_verifikasi' => now()
        ]);
    }

    // Method untuk mengecek apakah berkas sudah terverifikasi
    public function isTerverifikasi()
    {
        return $this->status_verifikasi === 'verified' && 
               !is_null($this->tanggal_verifikasi);
    }
}
