<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentfile extends Model
{
    use HasFactory;
    protected $table = 'studentfiles';

    protected $fillable = [
        'file_foto',
        'file_kartukeluarga',
        'file_aktakelahiran',
        'file_ijazah',
    ];
}
