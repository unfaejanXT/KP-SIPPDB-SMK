<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    
    protected $table = "operator";

    protected $fillable = [
        "user_id",
        "nama_operator",
        "is_active"
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the operator.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
