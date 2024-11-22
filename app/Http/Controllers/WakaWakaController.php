<?php

namespace App\Http\Controllers;

use App\Models\ActivoCorriente;
use App\Models\ActivoNoCorriente;
use App\Models\EstadoResultado;
use App\Models\PasivoCorriente;
use App\Models\PasivoNoCorriente;
use App\Models\Patrimonio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WakaWakaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_auth = Auth::id();
        $results = EstadoResultado::where('user_id', $id_auth)->get();
        $years = [];
        $index = 0;
        foreach($results as $item)
        {
            $year = $item->año;
            $years[$index] = $year;
            $index++;
        }
        return view('pages.WACC', compact('years'));
    }

    public function calcularWACC(Request $request)
    {
        $id_auth = Auth::id();
        $results = EstadoResultado::where('user_id', $id_auth)->get();
        $years = [];
        $index = 0;
        foreach($results as $item)
        {
            $year = $item->año;
            $years[$index] = $year;
            $index++;
        }
        // dd($years);
        // $backend = true;
        $data_year = $request->year;
        // dd($data_year);
        $pasivo_corriente = PasivoCorriente::where('user_id', $id_auth)->where('año', $data_year)->first(); 
        $total_pasivo_corriente = $pasivo_corriente->tributos + 
                                  $pasivo_corriente->cuentas_por_pagar_comerciales +
                                  $pasivo_corriente->obligaciones +
                                  $pasivo_corriente-> cuentas_por_pagar_diversas;

        $pasivo_no_corriente = PasivoNoCorriente::where('user_id', $id_auth)->where('año', $data_year)->first(); 
        $total_pasivo_no_corriente = $pasivo_no_corriente->obligaciones_largo_plazo +
        $pasivo_no_corriente->otros_pasivos;

        $activo_corriente = ActivoCorriente::where('user_id', $id_auth)->where('año', $data_year)->first();
        $total_activo_corriente = $activo_corriente->efectivo +
                                  $activo_corriente->inversion +
                                  $activo_corriente-> cuentas_por_cobrar +
                                  $activo_corriente->mercaderias +
                                  $activo_corriente->servicios;

        $activo_no_corriente = ActivoNoCorriente::where('user_id', $id_auth)->where('año', $data_year)->first();
        $total_activo_no_corriente = $activo_no_corriente->terrenos +
                                     $activo_no_corriente->edificaciones +
                                     $activo_no_corriente->muebles;

        $total_activo = $total_activo_corriente + $total_activo_no_corriente;                                

        // Utilidad de ejercicio
        $estado_resultados = EstadoResultado::where('user_id', $id_auth)->where('año', $data_year)->first();
        $utilidad_bruta = $estado_resultados->ventas -
                          ($estado_resultados->saldo_enero +
                          $estado_resultados->compras +
                          $estado_resultados->saldo_diciembre);
        $utilidad_operacion = $utilidad_bruta - $estado_resultados->gastos_operacionales;
        $utilidad_antes_impuestos = $utilidad_operacion - $estado_resultados->gastos_financieros;
        $utilidad_ejercicio = $utilidad_antes_impuestos - $estado_resultados->impuesto_renta;
        // dd($utilidad_bruta, $utilidad_operacion, $utilidad_antes_impuestos);

        $patrimonio = Patrimonio::where('user_id', $id_auth)->where('año', $data_year)->first(); 
        $total_patrimonio = $patrimonio->capital_social +
                            $patrimonio->beneficios +
                            $patrimonio->excedentes +
                            $patrimonio->reservas +
                            $patrimonio->utilidad_ejercicios_ant +
                            $utilidad_ejercicio;
        // Pasivos a corto y largo plazo
        // dd($total_pasivo_corriente, $total_pasivo_no_corriente, $total_activo);
        return view('pages.WACC', compact('years', 'data_year', 'total_activo', 'total_pasivo_corriente', 'total_pasivo_no_corriente', 'total_patrimonio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
