<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'kuota',
        'status'
    ];

    // Validasi rules
    public static function rules()
    {
        return [
            'kode' => 'required|string|max:10|unique:jurusan,kode',
            'nama' => 'required|string|max:100|unique:jurusan,nama',
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ];
    }

    // Relationship dengan Pendaftaran (jika ada)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    // Scope untuk jurusan aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk jurusan dengan kuota tersedia
    public function scopeKuotaTersedia($query)
    {
        return $query->where('kuota', '>', 0);
    }

    // Method untuk cek ketersediaan kuota
    public function isKuotaTersedia()
    {
        return $this->kuota > 0;
    }

    // Method untuk mengurangi kuota
    public function kurangiKuota()
    {
        if ($this->isKuotaTersedia()) {
            $this->decrement('kuota');
            return true;
        }
        return false;
    }

    // Method untuk menambah kuota
    public function tambahKuota($jumlah = 1)
    {
        $this->increment('kuota', $jumlah);
    }

    // Method untuk mengubah status
    public function ubahStatus($status)
    {
        $this->update(['status' => $status]);
    }

    // Accessor untuk format nama
    public function getNamaJurusanAttribute()
    {
        return ucwords($this->nama);
    }
}
