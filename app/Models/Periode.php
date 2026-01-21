<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_periode',
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];

    public function gelombangs()
    {
        return $this->hasMany(Gelombang::class, 'periode_id');
    }

    public function isBerlaku()
    {
        $today = now();
        return $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }
}
