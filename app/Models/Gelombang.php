<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gelombang extends Model
{
    use HasFactory;

    protected $table = 'gelombang';

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'tahun_ajaran',
        'kuota',
        'is_active',
        'periode_id',
    ];

    // Cast tipe data
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];



    // Method untuk cek apakah periode masih berlaku
    public function isBerlaku()
    {
        $today = now();
        return $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'gelombang_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
