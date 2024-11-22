<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Datos Financieros') }}
        </h2>
        <x-chat-g-p-t />
    </x-slot>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }
    </style>

    <div class="py-12 animate-fadeInUp">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 text-white">
                    <!-- Tabla -->
                    <section id="tabla-datos" class="relative overflow-x-auto my-8">
                        <h2 class="text-3xl font-bold mb-4" style="color: #6875f5;">DATOS FINANCIEROS
                        </h2>
                        <div class="flex justify-end gap-2 mb-4">
                            <button onclick="addYear()" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Agregar
                                Año</button>
                            <button onclick="removeYear()" class="mb-4 px-4 py-2 bg-red-500 text-white rounded">Eliminar
                                Año</button>
                        </div>

                        <form id="datosForm" method="POST" action="{{ route('datos.store') }}">
                            @csrf
                            <table
                                class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-gray-700">
                                        <th class="border px-4 py-2">Categoría</th>
                                        <th class="border px-4 py-2">Subcategoría</th>
                                        @foreach ($years as $year)
                                            <th class="border px-4 py-2">{{ $year }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Estado de Resultados -->
                                    <tr id="row_ventas">
                                        <td class="border px-4 py-2" rowspan="12">Estado de Resultados</td>
                                        <td class="border px-4 py-2">Ventas</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="ventas_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->ventas ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_saldo_enero">
                                        <td class="border px-4 py-2">Saldo Mercado 01 Enero</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="saldo_enero_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->saldo_enero ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_compras">
                                        <td class="border px-4 py-2">Compras</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="compras_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->compras ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_saldo_diciembre">
                                        <td class="border px-4 py-2">Saldo Mercado 31 Diciembre</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="saldo_diciembre_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->saldo_diciembre ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <!-- Filas Calculadas -->
                                    <tr class="calculated-row" id="row_costo_venta">
                                        <td class="border px-4 py-2">Costo de Ventas</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="costo_venta_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <tr class="calculated-row bg-gray-100 dark:bg-gray-900" id="row_utilidad_bruta">
                                        <td class="border px-4 py-2 font-bold">Utilidad Bruta</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="utilidad_bruta_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_gastos_operacionales">
                                        <td class="border px-4 py-2">Gastos Operacionales</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="gastos_operacionales_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->gastos_operacionales ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="calculated-row bg-gray-100 dark:bg-gray-900" id="row_utilidad_operacion">
                                        <td class="border px-4 py-2 font-bold">Utilidad de Operación</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="utilidad_operacion_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_gastos_financieros">
                                        <td class="border px-4 py-2">Gastos Financieros</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="gastos_financieros_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->gastos_financieros ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="calculated-row bg-gray-100 dark:bg-gray-900"
                                        id="row_utilidad_antes_impuestos">
                                        <td class="border px-4 py-2 font-bold">Utilidad antes de Impuestos</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="utilidad_antes_impuestos_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_impuesto_renta">
                                        <td class="border px-4 py-2">Impuesto a la Renta</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="impuesto_renta_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['estado_resultado']->impuesto_renta ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="calculated-row bg-gray-100 dark:bg-gray-900"
                                        id="row_utilidad_ejercicio">
                                        <td class="border px-4 py-2 font-bold">Utilidad de Ejercicio</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="utilidad_ejercicio_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>

                                    <!-- Activo Corriente -->
                                    <tr id="row_efectivo">
                                        <td class="border px-4 py-2" rowspan="5">Activo Corriente</td>
                                        <td class="border px-4 py-2">Efectivo y equivalente de efectivo</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="efectivo_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_corriente']->efectivo ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_inversiones_financieras">
                                        <td class="border px-4 py-2">Inversiones Financieras</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number"
                                                    id="inversiones_financieras_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_corriente']->inversion ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_cuentas_por_cobrar">
                                        <td class="border px-4 py-2">Cuentas por cobrar Comerciales</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="cuentas_por_cobrar_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_corriente']->cuentas_por_cobrar ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_mercaderias">
                                        <td class="border px-4 py-2">Mercaderías</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="mercaderias_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_corriente']->mercaderias ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_servicios_pagados">
                                        <td class="border px-4 py-2">Servicios pagados por anticipado</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="servicios_pagados_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_corriente']->servicios ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Activo Corriente -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_activo_corriente">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Activo Corriente
                                        </td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_activo_corriente_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>

                                    <!-- Activo No Corriente -->
                                    <tr id="row_terrenos">
                                        <td class="border px-4 py-2" rowspan="3">Activo No Corriente</td>
                                        <td class="border px-4 py-2">Terrenos</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="terrenos_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_no_corriente']->terrenos ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_edificaciones">
                                        <td class="border px-4 py-2">Edificaciones</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="edificaciones_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_no_corriente']->edificaciones ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_muebles">
                                        <td class="border px-4 py-2">Muebles y enseres</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="muebles_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['activo_no_corriente']->muebles ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Activo No Corriente -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_activo_no_corriente">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Activo No
                                            Corriente</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_activo_no_corriente_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Activo -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_activo">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Activo</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_activo_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>

                                    <!-- Pasivo Corriente -->
                                    <tr id="row_tributos">
                                        <td class="border px-4 py-2" rowspan="4">Pasivo Corriente</td>
                                        <td class="border px-4 py-2">Tributos por pagar</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="tributos_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['pasivo_corriente']->tributos ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_cuentas_comerciales">
                                        <td class="border px-4 py-2">Cuentas por pagar Comerciales</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="cuentas_comerciales_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['pasivo_corriente']->cuentas_por_pagar_comerciales ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_obligaciones">
                                        <td class="border px-4 py-2">Obligaciones financieras</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="obligaciones_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['pasivo_corriente']->obligaciones ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_cuentas_diversas">
                                        <td class="border px-4 py-2">Cuentas por pagar diversas</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="cuentas_diversas_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['pasivo_corriente']->cuentas_por_pagar_diversas ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Pasivo Corriente -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo_corriente">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo Corriente
                                        </td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_pasivo_corriente_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>

                                    <!-- Pasivo No Corriente -->
                                    <tr id="row_obligaciones_largo_plazo">
                                        <td class="border px-4 py-2" rowspan="2">Pasivo No Corriente</td>
                                        <td class="border px-4 py-2">Obligaciones Financieras a Largo Plazo</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number"
                                                    id="obligaciones_largo_plazo_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['pasivo_no_corriente']->obligaciones_largo_plazo ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_otros_pasivos">
                                        <td class="border px-4 py-2">Otros Pasivos</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="otros_pasivos_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['pasivo_no_corriente']->otros_pasivos ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Pasivo No Corriente -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo_no_corriente">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo No
                                            Corriente</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_pasivo_no_corriente_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Pasivo -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_pasivo_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>

                                    <!-- Patrimonio -->
                                    <tr id="row_capital_social">
                                        <td class="border px-4 py-2" rowspan="7">Patrimonio</td>
                                        <td class="border px-4 py-2">Capital Social</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="capital_social_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['patrimonio']->capital_social ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_beneficios">
                                        <td class="border px-4 py-2">Beneficios no realizados</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="beneficios_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['patrimonio']->beneficios ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_excedente">
                                        <td class="border px-4 py-2">Excedente de revaluación</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="excedente_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['patrimonio']->excedentes ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_reservas">
                                        <td class="border px-4 py-2">Reservas</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="reservas_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['patrimonio']->reservas ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr id="row_utilidad_anterior">
                                        <td class="border px-4 py-2">Utilidad ejercicios anteriores</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2">
                                                <input type="number" id="utilidad_anterior_{{ $year }}"
                                                    class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                    oninput="calcularTotales()"
                                                    value="{{ $data[$year]['patrimonio']->utilidad_ejercicios_ant ?? '' }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="calculated-row" id="row_utilidad_ejercicio_patrimonio">
                                        <td class="border px-4 py-2">Utilidad del ejercicio</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="utilidad_ejercicio_patrimonio_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Patrimonio -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_patrimonio">
                                        <td class="border px-4 py-2 font-bold">Total Patrimonio</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_patrimonio_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                    <!-- Total Pasivo y Patrimonio -->
                                    <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo_patrimonio">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo y
                                            Patrimonio</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold"
                                                id="total_pasivo_patrimonio_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>

                                    <!-- Fila de Diferencia -->
                                    <tr class="calculated-row bg-yellow-100 dark:bg-yellow-900" id="row_diferencia">
                                        <td class="border px-4 py-2 font-bold" colspan="2">Diferencia</td>
                                        @foreach ($years as $year)
                                            <td class="border px-4 py-2 font-bold text-red-500"
                                                id="diferencia_{{ $year }}">0</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </section>
                    <div class="flex justify-center">
                        <button type="button" onclick="guardarDatos()"
                            class="mb-4 px-4 py-2 bg-green-700 text-white rounded">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let years = @json($years);
        console.log(years)
        if (years.length === 0) {
            let currentYear = new Date().getFullYear();
            years = [currentYear];
        }

        let dataFromServer = @json($dataForJs);

        function addYear() {
            // Determinar el nuevo año a agregar
            let newYear = parseInt(years[years.length - 1]) - 1;

            // Verificar si el año ya existe
            if (years.includes(newYear)) {
                alert('El año ' + newYear + ' ya está agregado.');
                return;
            }
            years.push(newYear);
            addYearColumn(newYear);
            calcularTotales();
        }

        function removeYear() {
            if (years.length > 1) {
                let removedYear = years.pop();
                removeYearColumn(removedYear);
                calcularTotales();
            } else {
                alert('Debe haber al menos un año en la tabla.');
            }
        }

        // Función para agregar una columna de año
        function addYearColumn(year) {
            // Añadir encabezado de año
            let headerRow = document.querySelector('thead tr');
            let th = document.createElement('th');
            th.className = 'border px-4 py-2';
            th.innerText = year;
            headerRow.appendChild(th);

            // Obtener todas las filas del tbody
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                let cell;
                if (row.id === 'row_diferencia') {
                    // Añadir celda para la diferencia
                    cell = document.createElement('td');
                    cell.className = 'border px-4 py-2 font-bold text-red-500';
                    cell.id = 'diferencia_' + year;
                    cell.innerText = '0';
                } else if (row.id.startsWith('row_total') || row.classList.contains('calculated-row')) {
                    // Para filas de totales y calculadas
                    cell = document.createElement('td');
                    cell.className = 'border px-4 py-2 font-bold';
                    let cellId = row.id.substring(4) + '_' + year;
                    cell.id = cellId;
                    cell.innerText = '0';
                } else {
                    // Para filas de entrada
                    cell = document.createElement('td');
                    cell.className = 'border px-4 py-2';
                    let input = document.createElement('input');
                    input.type = 'number';
                    let inputId = row.id.substring(4) + '_' + year;
                    input.id = inputId;
                    input.className = 'bg-transparent w-full px-2 py-1 border rounded-md';
                    input.oninput = calcularTotales;

                    // Asignar valor si existe en dataFromServer
                    if (dataFromServer[year] && dataFromServer[year][inputId]) {
                        input.value = dataFromServer[year][inputId];
                    }

                    cell.appendChild(input);
                }
                row.appendChild(cell);
            });
        }

        // Función para eliminar una columna de año
        function removeYearColumn(year) {
            // Remover el encabezado
            let headerRow = document.querySelector('thead tr');
            let ths = headerRow.querySelectorAll('th');
            ths[ths.length - 1].remove();

            // Remover las celdas correspondientes en cada fila
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                let cells = row.querySelectorAll('td');
                cells[cells.length - 1].remove();
            });
        }


        function calcularTotales() {
            years.forEach(function(year) {
                // Obtener valores de Activo Corriente
                const efectivo = parseFloat(document.getElementById('efectivo_' + year).value) || 0;
                const inversiones_financieras = parseFloat(document.getElementById('inversiones_financieras_' +
                    year).value) || 0;
                const cuentas_por_cobrar = parseFloat(document.getElementById('cuentas_por_cobrar_' + year)
                    .value) || 0;
                const mercaderias = parseFloat(document.getElementById('mercaderias_' + year).value) || 0;
                const servicios_pagados = parseFloat(document.getElementById('servicios_pagados_' + year).value) ||
                    0;

                // Total Activo Corriente
                const total_activo_corriente = efectivo + inversiones_financieras + cuentas_por_cobrar +
                    mercaderias + servicios_pagados;
                document.getElementById('total_activo_corriente_' + year).innerText = total_activo_corriente;

                // Obtener valores de Activo No Corriente
                const terrenos = parseFloat(document.getElementById('terrenos_' + year).value) || 0;
                const edificaciones = parseFloat(document.getElementById('edificaciones_' + year).value) || 0;
                const muebles = parseFloat(document.getElementById('muebles_' + year).value) || 0;

                // Total Activo No Corriente
                const total_activo_no_corriente = terrenos + edificaciones + muebles;
                document.getElementById('total_activo_no_corriente_' + year).innerText = total_activo_no_corriente;

                // Total Activo
                const total_activo = total_activo_corriente + total_activo_no_corriente;
                document.getElementById('total_activo_' + year).innerText = total_activo;

                // Obtener valores de Pasivo Corriente
                const tributos = parseFloat(document.getElementById('tributos_' + year).value) || 0;
                const cuentas_comerciales = parseFloat(document.getElementById('cuentas_comerciales_' + year)
                    .value) || 0;
                const obligaciones = parseFloat(document.getElementById('obligaciones_' + year).value) || 0;
                const cuentas_diversas = parseFloat(document.getElementById('cuentas_diversas_' + year).value) || 0;

                // Total Pasivo Corriente
                const total_pasivo_corriente = tributos + cuentas_comerciales + obligaciones + cuentas_diversas;
                document.getElementById('total_pasivo_corriente_' + year).innerText = total_pasivo_corriente;

                // Obtener valores de Pasivo No Corriente
                const obligaciones_largo_plazo = parseFloat(document.getElementById('obligaciones_largo_plazo_' +
                    year).value) || 0;
                const otros_pasivos = parseFloat(document.getElementById('otros_pasivos_' + year).value) || 0;

                // Total Pasivo No Corriente
                const total_pasivo_no_corriente = obligaciones_largo_plazo + otros_pasivos;
                document.getElementById('total_pasivo_no_corriente_' + year).innerText = total_pasivo_no_corriente;

                // Total Pasivo
                const total_pasivo = total_pasivo_corriente + total_pasivo_no_corriente;
                document.getElementById('total_pasivo_' + year).innerText = total_pasivo;

                // Obtener valores de Estado de Resultados
                const saldo_enero = parseFloat(document.getElementById('saldo_enero_' + year).value) || 0;
                const compras = parseFloat(document.getElementById('compras_' + year).value) || 0;
                const saldo_diciembre = parseFloat(document.getElementById('saldo_diciembre_' + year).value) || 0;
                const ventas = parseFloat(document.getElementById('ventas_' + year).value) || 0;
                const gastos_operacionales = parseFloat(document.getElementById('gastos_operacionales_' + year)
                    .value) || 0;
                const gastos_financieros = parseFloat(document.getElementById('gastos_financieros_' + year)
                    .value) || 0;
                const impuesto_renta = parseFloat(document.getElementById('impuesto_renta_' + year).value) || 0;

                // Cálculos
                const costo_ventas = saldo_enero + compras + saldo_diciembre;
                document.getElementById('costo_venta_' + year).innerText = costo_ventas;

                const utilidad_bruta = ventas - costo_ventas;
                document.getElementById('utilidad_bruta_' + year).innerText = utilidad_bruta;

                const utilidad_operacion = utilidad_bruta - gastos_operacionales;
                document.getElementById('utilidad_operacion_' + year).innerText = utilidad_operacion;

                const utilidad_antes_impuestos = utilidad_operacion - gastos_financieros;
                document.getElementById('utilidad_antes_impuestos_' + year).innerText = utilidad_antes_impuestos;

                const utilidad_ejercicio = utilidad_antes_impuestos - impuesto_renta;
                document.getElementById('utilidad_ejercicio_' + year).innerText = utilidad_ejercicio;

                // Actualizar "Utilidad del ejercicio" en Patrimonio
                document.getElementById('utilidad_ejercicio_patrimonio_' + year).innerText = utilidad_ejercicio;

                // Obtener valores de Patrimonio (actualizados)
                const capital_social = parseFloat(document.getElementById('capital_social_' + year).value) || 0;
                const beneficios = parseFloat(document.getElementById('beneficios_' + year).value) || 0;
                const excedente = parseFloat(document.getElementById('excedente_' + year).value) || 0;
                const reservas = parseFloat(document.getElementById('reservas_' + year).value) || 0;
                const utilidad_anterior = parseFloat(document.getElementById('utilidad_anterior_' + year).value) ||
                    0;

                // Total Patrimonio (incluyendo la utilidad del ejercicio calculada)
                const total_patrimonio = capital_social + beneficios + excedente + reservas + utilidad_anterior +
                    utilidad_ejercicio;
                document.getElementById('total_patrimonio_' + year).innerText = total_patrimonio;

                // Total Pasivo y Patrimonio
                const total_pasivo_patrimonio = total_pasivo + total_patrimonio;
                document.getElementById('total_pasivo_patrimonio_' + year).innerText = total_pasivo_patrimonio;

                // Calcular la diferencia
                const diferencia = total_activo - total_pasivo_patrimonio;
                const diferenciaElement = document.getElementById('diferencia_' + year);
                diferenciaElement.innerText = diferencia;
                console.log(diferencia)
                // Aplicar estilos según la diferencia
                if (diferencia === 0) {
                    diferenciaElement.classList.remove('text-red-500');
                    diferenciaElement.classList.add('text-green-500');
                    diferenciaElement.innerText = '0 (Balanceado)';
                } else {
                    diferenciaElement.classList.remove('text-green-500');
                    diferenciaElement.classList.add('text-red-500');
                    diferenciaElement.innerText = diferencia + ' (Desbalanceado)';
                }
            });
        }

        // Ejecutar cálculos al cargar la página
        window.onload = function() {
            // Asegurarse de que todos los años estén representados en la tabla
            years.forEach(function(year) {
                if (!document.getElementById('ventas_' + year)) {
                    addYearColumn(year);
                }
            });

            calcularTotales();
        };
    </script>

    <script>
        function guardarDatos() {
            // 1. Validar que todos los campos estén llenos y que la diferencia sea cero
            let valid = true;
            let message = '';
            let data = {};

            years.forEach(function(year) {
                data[year] = {}; // Inicializar objeto para cada año
                let diferenciaElement = document.getElementById('diferencia_' + year);

                // Verificar que la diferencia sea cero y balanceado
                if (!diferenciaElement.innerText.includes('Balanceado')) {
                    valid = false;
                    message = 'No hay un balance para el año ' + year + '.';
                    return;
                }

                // Recorrer todos los campos de entrada para este año
                let inputs = document.querySelectorAll('input[id$="_' + year + '"]');
                inputs.forEach(function(input) {
                    if (input.value === '') {
                        valid = false;
                        message = 'Todos los campos deben estar llenos para el año ' + year + '.';
                        return;
                    }
                    // Obtener el nombre del campo sin el año
                    let fieldName = input.id.replace('_' + year, '');
                    data[year][fieldName] = parseFloat(input.value);
                });

                // Agregar campos calculados
                data[year]['utilidad_ejercicio'] = parseFloat(document.getElementById('utilidad_ejercicio_' + year)
                    .innerText);
            });

            if (!valid) {
                alert(message);
                return;
            }

            // 2. Enviar datos al servidor mediante AJAX
            fetch("{{ route('datos.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        data: data
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Datos guardados exitosamente.');
                        // Aquí puedes redirigir o actualizar la página si lo deseas
                    } else {
                        alert('Hubo un error al guardar los datos.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al guardar los datos.');
                });
        }
    </script>

</x-app-layout>
