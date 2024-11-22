<?php

namespace App\Http\Controllers;

use App\Models\ActivoCorriente;
use App\Models\ActivoNoCorriente;
use App\Models\EstadoResultado;
use App\Models\PasivoCorriente;
use App\Models\PasivoNoCorriente;
use App\Models\Patrimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        // Obtener datos de los modelos
        $estadoResultados = EstadoResultado::where('user_id', $user_id)->get();
        $activoCorrientes = ActivoCorriente::where('user_id', $user_id)->get();
        $activoNoCorrientes = ActivoNoCorriente::where('user_id', $user_id)->get();
        $pasivoCorrientes = PasivoCorriente::where('user_id', $user_id)->get();
        $pasivoNoCorrientes = PasivoNoCorriente::where('user_id', $user_id)->get();
        $patrimonios = Patrimonio::where('user_id', $user_id)->get();

        // Organizar los datos por año
        $data = [];

        // Estado de Resultados
        foreach ($estadoResultados as $item) {
            $year = $item->año;
            $data[$year]['estado_resultado'] = $item;
        }

        // Activo Corriente
        foreach ($activoCorrientes as $item) {
            $year = $item->año;
            $data[$year]['activo_corriente'] = $item;
        }

        // Activo No Corriente
        foreach ($activoNoCorrientes as $item) {
            $year = $item->año;
            $data[$year]['activo_no_corriente'] = $item;
        }

        // Pasivo Corriente
        foreach ($pasivoCorrientes as $item) {
            $year = $item->año;
            $data[$year]['pasivo_corriente'] = $item;
        }

        // Pasivo No Corriente
        foreach ($pasivoNoCorrientes as $item) {
            $year = $item->año;
            $data[$year]['pasivo_no_corriente'] = $item;
        }

        // Patrimonio
        foreach ($patrimonios as $item) {
            $year = $item->año;
            $data[$year]['patrimonio'] = $item;
        }

        // Obtener los años disponibles y ordenarlos
        $years = array_keys($data);

        // Preparar los datos para JavaScript
        $dataForJs = [];
        foreach ($data as $year => $models) {
            $dataForJs[$year] = [];

            // Estado de Resultados
            if (isset($models['estado_resultado'])) {
                $estado = $models['estado_resultado'];
                $dataForJs[$year]['ventas_' . $year] = $estado->ventas;
                $dataForJs[$year]['saldo_enero_' . $year] = $estado->saldo_enero;
                $dataForJs[$year]['compras_' . $year] = $estado->compras;
                $dataForJs[$year]['saldo_diciembre_' . $year] = $estado->saldo_diciembre;
                $dataForJs[$year]['gastos_operacionales_' . $year] = $estado->gastos_operacionales;
                $dataForJs[$year]['gastos_financieros_' . $year] = $estado->gastos_financieros;
                $dataForJs[$year]['impuesto_renta_' . $year] = $estado->impuesto_renta;
            }

            // Activo Corriente
            if (isset($models['activo_corriente'])) {
                $activoC = $models['activo_corriente'];
                $dataForJs[$year]['efectivo_' . $year] = $activoC->efectivo;
                $dataForJs[$year]['inversiones_financieras_' . $year] = $activoC->inversion;
                $dataForJs[$year]['cuentas_por_cobrar_' . $year] = $activoC->cuentas_por_cobrar;
                $dataForJs[$year]['mercaderias_' . $year] = $activoC->mercaderias;
                $dataForJs[$year]['servicios_pagados_' . $year] = $activoC->servicios;
            }

            // Activo No Corriente
            if (isset($models['activo_no_corriente'])) {
                $activoNC = $models['activo_no_corriente'];
                $dataForJs[$year]['terrenos_' . $year] = $activoNC->terrenos;
                $dataForJs[$year]['edificaciones_' . $year] = $activoNC->edificaciones;
                $dataForJs[$year]['muebles_' . $year] = $activoNC->muebles;
            }

            // Pasivo Corriente
            if (isset($models['pasivo_corriente'])) {
                $pasivoC = $models['pasivo_corriente'];
                $dataForJs[$year]['tributos_' . $year] = $pasivoC->tributos;
                $dataForJs[$year]['cuentas_comerciales_' . $year] = $pasivoC->cuentas_por_pagar_comerciales;
                $dataForJs[$year]['obligaciones_' . $year] = $pasivoC->obligaciones;
                $dataForJs[$year]['cuentas_diversas_' . $year] = $pasivoC->cuentas_por_pagar_diversas;
            }

            // Pasivo No Corriente
            if (isset($models['pasivo_no_corriente'])) {
                $pasivoNC = $models['pasivo_no_corriente'];
                $dataForJs[$year]['obligaciones_largo_plazo_' . $year] = $pasivoNC->obligaciones_largo_plazo;
                $dataForJs[$year]['otros_pasivos_' . $year] = $pasivoNC->otros_pasivos;
            }

            // Patrimonio
            if (isset($models['patrimonio'])) {
                $patrimonio = $models['patrimonio'];
                $dataForJs[$year]['capital_social_' . $year] = $patrimonio->capital_social;
                $dataForJs[$year]['beneficios_' . $year] = $patrimonio->beneficios;
                $dataForJs[$year]['excedente_' . $year] = $patrimonio->excedentes;
                $dataForJs[$year]['reservas_' . $year] = $patrimonio->reservas;
                $dataForJs[$year]['utilidad_anterior_' . $year] = $patrimonio->utilidad_ejercicios_ant;
            }
        }

        // Pasar los datos y los años a la vista
        return view('pages.datos', compact('data', 'years', 'dataForJs'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $data = $request->input('data');
        
        // Validar que data no esté vacío
        if (!$data || empty($data)) {
            return response()->json(['success' => false, 'message' => 'No se recibieron datos.']);
        }

        foreach ($data as $year => $values) {
            
            // Estado de Resultados
            EstadoResultado::updateOrCreate(
                ['user_id' => $user_id, 'año' => $year],
                [
                    'ventas' => $values['ventas'],
                    'saldo_enero' => $values['saldo_enero'],
                    'compras' => $values['compras'],
                    'saldo_diciembre' => $values['saldo_diciembre'],
                    'gastos_operacionales' => $values['gastos_operacionales'],
                    'gastos_financieros' => $values['gastos_financieros'],
                    'impuesto_renta' => $values['impuesto_renta'],
                ]
            );

            // Activo Corriente
            ActivoCorriente::updateOrCreate(
                ['user_id' => $user_id, 'año' => $year],
                [
                    'efectivo' => $values['efectivo'],
                    'inversion' => $values['inversiones_financieras'],
                    'cuentas_por_cobrar' => $values['cuentas_por_cobrar'],
                    'mercaderias' => $values['mercaderias'],
                    'servicios' => $values['servicios_pagados'],
                ]
            );

            // Activo No Corriente
            ActivoNoCorriente::updateOrCreate(
                ['user_id' => $user_id, 'año' => $year],
                [
                    'terrenos' => $values['terrenos'],
                    'edificaciones' => $values['edificaciones'],
                    'muebles' => $values['muebles'],
                ]
            );

            // Pasivo Corriente
            PasivoCorriente::updateOrCreate(
                ['user_id' => $user_id, 'año' => $year],
                [
                    'tributos' => $values['tributos'],
                    'cuentas_por_pagar_comerciales' => $values['cuentas_comerciales'],
                    'obligaciones' => $values['obligaciones'],
                    'cuentas_por_pagar_diversas' => $values['cuentas_diversas'],
                ]
            );

            // Pasivo No Corriente
            PasivoNoCorriente::updateOrCreate(
                ['user_id' => $user_id, 'año' => $year],
                [
                    'obligaciones_largo_plazo' => $values['obligaciones_largo_plazo'],
                    'otros_pasivos' => $values['otros_pasivos'],
                ]
            );

            // Patrimonio
            Patrimonio::updateOrCreate(
                ['user_id' => $user_id, 'año' => $year],
                [
                    'capital_social' => $values['capital_social'],
                    'beneficios' => $values['beneficios'],
                    'excedentes' => $values['excedente'],
                    'reservas' => $values['reservas'],
                    'utilidad_ejercicios_ant' => $values['utilidad_anterior'],
                    // Si deseas guardar 'utilidad_ejercicio', puedes agregarlo aquí
                ]
            );
            
        }

        return response()->json(['success' => true, 'message' => 'Datos guardados exitosamente.']);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
