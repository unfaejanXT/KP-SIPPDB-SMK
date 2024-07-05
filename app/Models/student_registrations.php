<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_registrations extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'gol_darah',
        'agama',
        'alamat',
        'nohp',
        'asal_sekolah',
        'tanggal_daftar',
        'userId',
        'documentsId',
        'parentId'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];

    /**
     * Get the user that owns the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the document associated with the registration.
     */
    public function document()
    {
        return $this->belongsTo(documents::class, 'documentsId');
    }

    /**
     * Get the parent associated with the registration.
     */
    public function parent()
    {
        return $this->belongsTo(parents::class, 'parentId');
    }
}
