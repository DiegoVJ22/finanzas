<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoResultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'año',
        'ventas',
        'saldo_enero',
        'compras',
        'saldo_diciembre',
        'gastos_operacionales',
        'gastos_financieros',
        'impuesto_renta',
    ];

    public $timestamps = false;
}
