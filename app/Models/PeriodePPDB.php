<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeriodePPDB extends Model
{
    use HasFactory;

    protected $table = 'periodeppdb';

    protected $fillable = [
        'kode_periode',
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'tahun_ajaran',
        'status',
        'keterangan'
    ];

    // Cast tipe data
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status' => 'boolean',
    ];

    // Validasi data
    public static function rules()
    {
        return [
            'kode_periode' => 'required|string|max:20|unique:periodeppdb,kode_periode',
            'nama_periode' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tahun_ajaran' => 'required|string|regex:/^\d{4}\/\d{4}$/',
            'status' => 'boolean',
            'keterangan' => 'nullable|string'
        ];
    }

    // Scope untuk periode aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    // Accessor untuk format tanggal yang lebih readable
    public function getTanggalMulaiFormattedAttribute()
    {
        return $this->tanggal_mulai->format('d F Y');
    }

    public function getTanggalSelesaiFormattedAttribute()
    {
        return $this->tanggal_selesai->format('d F Y');
    }

    // Method untuk cek apakah periode masih berlaku
    public function isBerlaku()
    {
        $today = now();
        return $this->status && 
               $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    // Accessor untuk format tahun ajaran yang lebih user-friendly
    public function getTahunAjaranFormattedAttribute()
    {
        return substr($this->tahun_ajaran, 0, 4) . ' - ' . substr($this->tahun_ajaran, 5, 4);
    }
}
