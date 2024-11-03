<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentparent extends Model
{
    use HasFactory;

    protected $table = 'studentparents';

    protected $fillable = [
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'nohp_wali',
        'nohp_orangtua',
    ];
}
