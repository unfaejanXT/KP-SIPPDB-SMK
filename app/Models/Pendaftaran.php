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
        'user_id',
        'periodeppdb_id',
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

    // Relasi ke tabel 'periodeppdb' (periode PPDB)
    public function periodePPDB()
    {
        return $this->belongsTo(PeriodePPDB::class, 'periodeppdb_id');
    }

    // Relasi ke tabel 'Jurusan'
    public function jurusan():BelongsTo{
        return $this->belongsTo(Jurusan::class,'jurusan_id');
    }

    // Validasi untuk data pendaftaran
    public static function rules()
    {
        return [
            'nisn' => 'required|string|max:10|unique:pendaftaran,nisn',
            'nama_lengkap' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P', // L = Laki-laki, P = Perempuan
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'golongan_darah' => 'nullable|string|max:2',
            'agama' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id', // Asumsi ada tabel 'users' dengan field 'id'
            'periodeppdb_id' => 'required|exists:periodeppdb,id', // Asumsi ada tabel 'periodeppdb' dengan field 'id'
            'jurusan_id' => 'required|exist:jurusan,id'
        ];
    }

    // Relasi ke tabel 'berkas'
    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'pendaftaran_id');
    }

    // Scope untuk mencari pendaftaran berdasarkan status aktif
    public function scopeAktif($query)
    {
        return $query->whereHas('periodePPDB', function ($q) {
            $q->where('status', true);
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
