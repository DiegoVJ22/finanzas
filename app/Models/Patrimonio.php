<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'año',
        'capital_social',
        'beneficios',
        'excedentes',
        'reservas',
        'utilidad_ejercicios_ant',
    ];

    public $timestamps = false;
}
