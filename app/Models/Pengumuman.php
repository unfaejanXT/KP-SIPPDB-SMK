<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'konten',
        'views',
        'is_pinned',
        'status',
    ];
}
