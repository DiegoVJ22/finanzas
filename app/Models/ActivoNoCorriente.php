<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoNoCorriente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'año',
        'terrenos',
        'edificaciones',
        'muebles',
    ];

    public $timestamps = false;
}
