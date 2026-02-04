<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'no_pendaftaran',
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'agama',
        'alamat_rumah',
        'nomor_hp',
        'asal_sekolah',
        'pas_foto',
        'user_id',
        'gelombang_id',
        'jurusan_id',
        'status',
        'current_step'
    ];

    // Cast tipe data untuk beberapa field
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke tabel 'users' (pengguna yang melakukan pendaftaran)
    public function user()
    {
        return $this->belongsTo(User::class);  // Jika ada model User
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTuaSiswa::class, 'pendaftaran_id');
    }

    // Relasi ke tabel 'gelombangs' (Gelombang PPDB)
    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class, 'gelombang_id');
    }

    // Relasi ke tabel 'Jurusan'
    public function jurusan():BelongsTo{
        return $this->belongsTo(Jurusan::class,'jurusan_id');
    }



    // Relasi ke tabel 'berkas'
    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'pendaftaran_id');
    }

    // Scope untuk mencari pendaftaran berdasarkan status aktif
    public function scopeAktif($query)
    {
        return $query->whereHas('gelombang', function ($q) {
            $q->where('is_active', true);
        });
    }

    // Method untuk mendapatkan usia berdasarkan tanggal lahir
    public function getUsiaAttribute()
    {
        return now()->diffInYears($this->tanggal_lahir);
    }

    // Method untuk memformat tanggal lahir menjadi format yang lebih mudah dibaca
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir->format('d F Y');
    }
}
