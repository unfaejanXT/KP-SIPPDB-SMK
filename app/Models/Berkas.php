<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    public $timestamps = false;

    protected $fillable = [
        'pendaftaran_id',
        'jenis_berkas_id',
        'file_path',
        'status_verifikasi',
        'catatan_verifikasi',
        'uploaded_at',
        'verified_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function jenisBerkas()
    {
        return $this->belongsTo(JenisBerkas::class);
    }

    public function scopeTerverifikasi($query)
    {
        return $query->whereNotNull('verified_at')
                    ->where('status_verifikasi', 'verified');
    }

    public function verifikasi($status, $catatan = null)
    {
        $this->update([
            'status_verifikasi' => $status,
            'catatan_verifikasi' => $catatan,
            'verified_at' => now()
        ]);
    }

    public function isTerverifikasi()
    {
        return $this->status_verifikasi === 'verified' && 
               !is_null($this->verified_at);
    }
}
