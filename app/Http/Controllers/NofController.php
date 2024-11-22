<?php

namespace App\Http\Controllers;

use App\Models\ActivoCorriente;
use App\Models\EstadoResultado;
use App\Models\PasivoCorriente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NofController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        $years = []; // Colección de años con datos

        // Recuperar datos para el usuario
        $estadoResultados = EstadoResultado::where('user_id', $user_id)->get();
        $activoCorrientes = ActivoCorriente::where('user_id', $user_id)->get();
        $pasivoCorrientes = PasivoCorriente::where('user_id', $user_id)->get();

        $data = [];

        // Organizar datos por año
        foreach ($estadoResultados as $estadoResultado) {
            $year = $estadoResultado->año;
            $years[] = $year;
            $data[$year]['estado_resultado'] = $estadoResultado;
        }

        foreach ($activoCorrientes as $activoCorriente) {
            $year = $activoCorriente->año;
            $years[] = $year;
            $data[$year]['activo_corriente'] = $activoCorriente;
        }

        foreach ($pasivoCorrientes as $pasivoCorriente) {
            $year = $pasivoCorriente->año;
            $years[] = $year;
            $data[$year]['pasivo_corriente'] = $pasivoCorriente;
        }

        // Eliminar años duplicados y ordenar
        $years = array_unique($years);

        // Realizar cálculos para cada año
        foreach ($years as $year) {
            // Valores recuperados
            $ventas = $data[$year]['estado_resultado']->ventas ?? null;
            $cuentas_por_cobrar = $data[$year]['activo_corriente']->cuentas_por_cobrar ?? null;
            $mercaderias = $data[$year]['activo_corriente']->mercaderias ?? null;
            $saldo_enero = $data[$year]['estado_resultado']->saldo_enero ?? null;
            $compras = $data[$year]['estado_resultado']->compras ?? null;
            $saldo_diciembre = $data[$year]['estado_resultado']->saldo_diciembre ?? null;
            $cuentas_por_pagar_comerciales = $data[$year]['pasivo_corriente']->cuentas_por_pagar_comerciales ?? null;

            $efectivo = $data[$year]['activo_corriente']->efectivo ?? null;
            $inversion = $data[$year]['activo_corriente']->inversion ?? null;
            $servicios = $data[$year]['activo_corriente']->servicios ?? null;
            $tributos = $data[$year]['pasivo_corriente']->tributos ?? null;
            $obligaciones = $data[$year]['pasivo_corriente']->obligaciones ?? null;
            $cuentas_por_pagar_diversas = $data[$year]['pasivo_corriente']->cuentas_por_pagar_diversas ?? null;

            // Cálculos para Saldo NOF 1
            if ($ventas !== null && $cuentas_por_cobrar !== null) {
                $rotacion_cxc = $cuentas_por_cobrar != 0 ? $ventas / $cuentas_por_cobrar : 0;
                $cxc_diarias = $cuentas_por_cobrar / 360;
                $prom_cobro = $rotacion_cxc != 0 ? 360 / $rotacion_cxc : 0;
                $saldo_nof1 = $cxc_diarias * $prom_cobro;
            } else {
                $rotacion_cxc = $cxc_diarias = $prom_cobro = $saldo_nof1 = 0;
            }

            // Cálculos para Saldo NOF 2
            if ($ventas !== null && $saldo_enero !== null && $compras !== null && $saldo_diciembre !== null && $mercaderias !== null) {
                $costo_ventas = $ventas + $saldo_enero + $compras + $saldo_diciembre;
                $rotacion_inv = $mercaderias != 0 ? $costo_ventas / $mercaderias : 0;
                $inventario_diario = $mercaderias / 360;
                $prom_inv = $rotacion_inv != 0 ? 360 / $rotacion_inv : 0;
                $saldo_nof2 = $inventario_diario * $prom_inv;
            } else {
                $costo_ventas = $rotacion_inv = $inventario_diario = $prom_inv = $saldo_nof2 = 0;
            }

            // Cálculos para Saldo NOF 3
            if ($ventas !== null && $saldo_enero !== null && $compras !== null && $saldo_diciembre !== null && $cuentas_por_pagar_comerciales !== null) {
                $costo_ventas_cxp = $ventas + $saldo_enero + $compras + $saldo_diciembre;
                $rotacion_cxp = $cuentas_por_pagar_comerciales != 0 ? $costo_ventas_cxp / $cuentas_por_pagar_comerciales : 0;
                $cxp_diaria = $cuentas_por_pagar_comerciales / 360;
                $prom_pago = $rotacion_cxp != 0 ? 360 / $rotacion_cxp : 0;
                $saldo_nof3 = $cxp_diaria * $prom_pago;
            } else {
                $rotacion_cxp = $cxp_diaria = $prom_pago = $saldo_nof3 = 0;
            }

            // Cálculos para FM
            if ($efectivo !== null && $inversion !== null && $cuentas_por_cobrar !== null && $mercaderias !== null && $servicios !== null && $tributos !== null && $cuentas_por_pagar_comerciales !== null && $obligaciones !== null && $cuentas_por_pagar_diversas !== null) {
                $total_activo_corriente = $efectivo + $inversion + $cuentas_por_cobrar + $mercaderias + $servicios;
                $total_pasivo_corriente = $tributos + $cuentas_por_pagar_comerciales + $obligaciones + $cuentas_por_pagar_diversas;
                $fm = $total_activo_corriente - $total_pasivo_corriente;
            } else {
                $total_activo_corriente = $total_pasivo_corriente = $fm = 0;
            }

            // Cálculo de NOF y Ratio
            $nof = $saldo_nof1 + $saldo_nof2 - $saldo_nof3;
            $ratio = $nof != 0 ? $fm / $nof : 0;

            // Almacenar los cálculos y valores en el array data
            $data[$year]['calculations'] = [
                // Saldo NOF 1
                'ventas' => $ventas,
                'rotacion_cxc' => $rotacion_cxc,
                'cxc_diarias' => $cxc_diarias,
                'prom_cobro' => $prom_cobro,
                'saldo_nof1' => $saldo_nof1,

                // Saldo NOF 2
                'costo_ventas' => $costo_ventas,
                'rotacion_inv' => $rotacion_inv,
                'inventario_diario' => $inventario_diario,
                'prom_inv' => $prom_inv,
                'saldo_nof2' => $saldo_nof2,

                // Saldo NOF 3
                'costo_ventas_cxp' => $costo_ventas_cxp,
                'rotacion_cxp' => $rotacion_cxp,
                'cxp_diaria' => $cxp_diaria,
                'prom_pago' => $prom_pago,
                'saldo_nof3' => $saldo_nof3,

                // FM y Ratio
                'fm' => $fm,
                'nof' => $nof,
                'ratio' => $ratio,
            ];
        }

        // Pasar los datos a la vista
        return view('pages.nof', compact('data', 'years'));
    }
}
