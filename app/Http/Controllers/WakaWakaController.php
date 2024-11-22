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

        $rf = ($request->rf)/100;
        $rm = ($request->rm)/100;
        $beta = ($request->beta)/100;
        $riesgo_pais = ($request->input('riesgo-pais'))/100;
        $i1 = ($request->i1)/100;
        $i2 = ($request->i2)/100;
        $frecuencia1 = $request->frecuencia1;
        $frecuencia2 = $request->frecuencia2;
        $rq = $rf + $beta * ($rm - $rf) + $riesgo_pais;
        $wd = ($total_pasivo_corriente + $total_pasivo_no_corriente) / $total_activo;
        $wq = 1 - $wd;
        $betaA = $beta * (1 + (1 - 0.295) * $wd);
        switch($frecuencia1){
            case "diaria":
                $erwin1 = 1;
                break;
            case "semanal":
                $erwin1 = 7;
                break;
            case "mensual":
                $erwin1 = 30;
                break;
            case "bimestral":
                $erwin1 = 60;
                break;
            case "trimestral":
                $erwin1 = 90;
                break;
            case "semestral":
                $erwin1 = 180;
                break;
            default:
                $erwin1 = 360;
                break;
        }
        if($erwin1!=360){
            $ieq1 = ((1 + $i1) ** (360 / $erwin1)) - 1;
        }else{
            $ieq1 = $i1;
        }
        switch ($frecuencia2) {
            case "diaria":
                $erwin2 = 1;
                break;
            case "semanal":
                $erwin2 = 7;
                break;
            case "mensual":
                $erwin2 = 30;
                break;
            case "bimestral":
                $erwin2 = 60;
                break;
            case "trimestral":
                $erwin2 = 90;
                break;
            case "semestral":
                $erwin2 = 180;
                break;
            default:
                $erwin2 = 360;
                break;
        }
        if ($erwin2 != 360) {
            $ieq2 = ((1 + $i2) ** (360 / $erwin2)) - 1;
        } else {
            $ieq2 = $i2;
        }
        $ponde1 = ($total_pasivo_corriente / ($total_pasivo_corriente + $total_pasivo_no_corriente)) * $ieq1;
        $ponde2 = ($total_pasivo_no_corriente / ($total_pasivo_corriente + $total_pasivo_no_corriente)) * $ieq2;
        $tasad = $ponde1 + $ponde2;
        $wacc = ($wd * $tasad * (1 - 0.295) + $wq * $rq) * 100;
        $wacc = number_format($wacc, 2);
        // Pasivos a corto y largo plazo
        // dd($total_pasivo_corriente, $total_pasivo_no_corriente, $total_activo);
        return view('pages.WACC', compact('years', 'data_year', 'total_activo', 'total_pasivo_corriente', 'total_pasivo_no_corriente', 'total_patrimonio', 'wacc'));
    }

    function calculateIeq($i, $f, $c, $m)
    {
        if ($f === $c && $c === $m) {
            return $i;
        } else if ($f == $c && $c != $m) {
            $base = 1 + $i;

            switch ($f) {
                case "diaria":
                    $a = 1;
                    break;
                case "semanal":
                    $a = 7;
                    break;
                case "mensual":
                    $a = 30;
                    break;
                case "bimestral":
                    $a = 60;
                    break;
                case "trimestral":
                    $a = 90;
                    break;
                case "semestral":
                    $a = 180;
                    break;
                default:
                    $a = 360;
                    break;
            }

            switch ($m) {
                case "diaria":
                    $b = 1;
                    break;
                case "semanal":
                    $b = 7;
                    break;
                case "mensual":
                    $b = 30;
                    break;
                case "bimestral":
                    $b = 60;
                    break;
                case "trimestral":
                    $b = 90;
                    break;
                case "semestral":
                    $b = 180;
                    break;
                default:
                    $b = 360;
                    break;
            }

            $exponent = $b / $a;
            $result = pow($base, $exponent) - 1;
            return $result;
        } else if ($f != $c) {
            $base = 1 + $i;

            switch ($c) {
                case "diaria":
                    $a = 1;
                    break;
                case "semanal":
                    $a = 7;
                    break;
                case "mensual":
                    $a = 30;
                    break;
                case "bimestral":
                    $a = 60;
                    break;
                case "trimestral":
                    $a = 90;
                    break;
                case "semestral":
                    $a = 180;
                    break;
                default:
                    $a = 360;
                    break;
            }

            switch ($f) {
                case "diaria":
                    $b = 1;
                    break;
                case "semanal":
                    $b = 7;
                    break;
                case "mensual":
                    $b = 30;
                    break;
                case "bimestral":
                    $b = 60;
                    break;
                case "trimestral":
                    $b = 90;
                    break;
                case "semestral":
                    $b = 180;
                    break;
                default:
                    $b = 360;
                    break;
            }

            $exponent = $a / $b;
            $result = pow($base, $exponent) - 1;
            return $result;
        }
    }

    function calculateIeq2($i, $f, $l)
    {
        if ($f != $l) {
            $base = 1 + $i;

            switch ($l) {
                case "diaria":
                    $a = 1;
                    break;
                case "semanal":
                    $a = 7;
                    break;
                case "mensual":
                    $a = 30;
                    break;
                case "bimestral":
                    $a = 60;
                    break;
                case "trimestral":
                    $a = 90;
                    break;
                case "semestral":
                    $a = 180;
                    break;
                default:
                    $a = 360;
                    break;
            }

            switch ($f) {
                case "diaria":
                    $b = 1;
                    break;
                case "semanal":
                    $b = 7;
                    break;
                case "mensual":
                    $b = 30;
                    break;
                case "bimestral":
                    $b = 60;
                    break;
                case "trimestral":
                    $b = 90;
                    break;
                case "semestral":
                    $b = 180;
                    break;
                default:
                    $b = 360;
                    break;
            }

            $exponent = $a / $b;
            $result = pow($base, $exponent) - 1;
            return $result;
        } else {
            return $i;
        }
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
