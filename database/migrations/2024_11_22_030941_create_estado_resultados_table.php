<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estado_resultados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('año');
            $table->float('ventas');
            $table->float('saldo_enero');
            $table->float('compras');
            $table->float('saldo_diciembre');
            #$table->float('costo_ventas');
            #$table->float('utilidad_bruta');
            $table->float('gastos_operacionales');
            #$table->float('utilidad_operacion');
            $table->float('gastos_financieros');
            #$table->float('utilidad_antes_impuestos');
            $table->float('impuesto_renta');
            #$table->float('utilidad_ejercicio');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_resultados');
    }
};
