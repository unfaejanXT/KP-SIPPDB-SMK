<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBerkas extends Model
{
    use HasFactory;

    protected $table = 'jenis_berkas';

    protected $fillable = [
        'kode_berkas',
        'nama_berkas',
        'is_wajib',
        'is_active',
    ];

    protected $casts = [
        'is_wajib' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function berkas()
    {
        return $this->hasMany(Berkas::class);
    }
}
