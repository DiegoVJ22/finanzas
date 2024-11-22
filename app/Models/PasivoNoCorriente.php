<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasivoNoCorriente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'año',
        'obligaciones_largo_plazo',
        'otros_pasivos',
    ];

    public $timestamps = false;
}
