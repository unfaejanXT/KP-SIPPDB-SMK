<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $table = "operator";

    protected $fillable = [
        "nip",
        "nama_operator",
        "jabatan", 
        "noHP"
    ];
}
