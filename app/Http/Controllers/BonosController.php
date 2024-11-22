<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BonosController extends Controller
{
    public function index()
    {
        return view('pages.bonos');
    }

    public function calcular(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'cupon' => 'required|numeric',
            'tasa' => 'required|numeric',
            'periodo' => 'required|string',
            'valor_nominal' => 'required|numeric',
            'plazo' => 'required|integer|min:1',
        ]);

        // Datos del formulario
        $cupon = $validated['cupon']/100;
        $tasa = $validated['tasa'] / 100; // Convertimos porcentaje a decimal
        $valorNominal = $validated['valor_nominal'];
        $plazo = $validated['plazo']; // En años
        $periodo = match ($validated['periodo']) {
            'anual' => 1,
            'semestral' => 2,
            'trimestral' => 4,
            'mensual' => 12,
        };

        // Ajustamos los valores en función del período
        $cuponPorPeriodo = ($cupon / $periodo) * $valorNominal;
        $tasaPorPeriodo = $tasa / $periodo;
        $numPeriodos = $plazo * $periodo;

        // Fórmula para calcular el precio del bono
        $valorActualCupones = $cuponPorPeriodo * ((1 - pow(1 + $tasaPorPeriodo, -$numPeriodos)) / $tasaPorPeriodo);
        $valorActualNominal = $valorNominal / pow(1 + $tasaPorPeriodo, $numPeriodos);
        $precioBono = $valorActualCupones + $valorActualNominal;

        // Retornamos el resultado redondeado
        return back()->withInput()->with('resultado', round($precioBono, 2));
    }
}
