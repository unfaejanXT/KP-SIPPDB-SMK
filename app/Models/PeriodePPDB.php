<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeriodePPDB extends Model
{
    use HasFactory;

    protected $table = 'periodeppdb';

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'tahun_ajaran',
    ];

    // Cast tipe data
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Validasi data
    public static function rules()
    {
        return [
            'nama' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tahun_ajaran' => 'required|string|regex:/^\d{4}\/\d{4}$/',
        ];
    }

    // Method untuk cek apakah periode masih berlaku
    public function isBerlaku()
    {
        $today = now();
        return $this->status && 
               $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'periodeppdb_id');
    }

}
