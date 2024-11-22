<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasivoCorriente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'año',
        'tributos',
        'cuentas_por_pagar_comerciales',
        'obligaciones',
        'cuentas_por_pagar_diversas',
    ];

    public $timestamps = false;
}
