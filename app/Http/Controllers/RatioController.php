<?php

namespace App\Http\Controllers;

use App\Models\EstadoResultado;
use App\Models\ActivoCorriente;
use App\Models\ActivoNoCorriente;
use App\Models\Patrimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $filtro = $request->get('periodos');

        $periodo = Patrimonio::where('user_id', $user_id)
            ->select('año')
            ->get();

        if (!$filtro) {
            $beneficio = null;
            return view('pages.ratios', compact('periodo', 'beneficio'));
        }

        $estado_resultados = EstadoResultado::where('user_id', $user_id)->where('año', $filtro)->first();
        $utilidad_bruta = $estado_resultados->ventas -
                        ($estado_resultados->saldo_enero +
                        $estado_resultados->compras +
                        $estado_resultados->saldo_diciembre);
        $utilidad_operacion = $utilidad_bruta - $estado_resultados->gastos_operacionales;
        $utilidad_antes_impuestos = $utilidad_operacion - $estado_resultados->gastos_financieros;
        $utilidad_ejercicio = $utilidad_antes_impuestos - $estado_resultados->impuesto_renta;

        $beneficio = Patrimonio::where('user_id', $user_id)
            ->where('año', $filtro)
            ->selectRaw('sum(beneficios + capital_social + excedentes + reservas + utilidad_ejercicios_ant) as total')
            ->first();

            $activo_corriente = ActivoCorriente::where('user_id', $user_id)->where('año', $filtro)
            ->selectRaw('sum(efectivo + inversion + cuentas_por_cobrar + mercaderias + servicios) as totalAC')
            ->first();
    
            $activo_no_corriente = ActivoNoCorriente::where('user_id', $user_id)->where('año', $filtro)
            ->selectRaw('sum(terrenos + edificaciones + muebles) as totalANC')
            ->first();
    
            $total_activo = $activo_corriente->totalAC + $activo_no_corriente->totalANC;  

        $patrimonio = Patrimonio::where('user_id', $user_id)->where('año', $filtro)
        ->selectRaw('sum(capital_social + beneficios + excedentes + reservas + utilidad_ejercicios_ant) as total_patrimonio')
        ->first(); 
        
        return view('pages.ratios', compact('periodo', 'beneficio' ,'utilidad_ejercicio', 'total_activo', 'patrimonio'));
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
