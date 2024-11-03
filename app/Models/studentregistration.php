<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentregistration extends Model
{
    use HasFactory;
    protected $table = 'studentregistrations';

    protected $fillable = [
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
        'tanggal_daftar',
        'studentparent_id',
        'studentfile_id',
    ];

    public function studentParent()
    {
        return $this->belongsTo(studentparent::class);
    }

    public function studentFile()
    {
        return $this->belongsTo(studentfile::class);
    }
}
