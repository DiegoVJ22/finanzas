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
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 text-white">
                    <!-- Tabla -->
                    <section id="tabla-datos" class="relative overflow-x-auto">

                        <button onclick="addYear()" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Agregar Año</button>
                        <button onclick="removeYear()" class="mb-4 px-4 py-2 bg-red-500 text-white rounded">Eliminar Año</button>

                        <table class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Categoría</th>
                                    <th class="border px-4 py-2">Subcategoría</th>
                                    <th class="border px-4 py-2">2024</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Estado de Resultados -->
                                <tr id="row_ventas">
                                    <td class="border px-4 py-2" rowspan="12">Estado de Resultados</td>
                                    <td class="border px-4 py-2">Ventas</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="ventas_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_saldo_enero">
                                    <td class="border px-4 py-2">Saldo Mercado 01 Enero</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="saldo_enero_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_compras">
                                    <td class="border px-4 py-2">Compras</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="compras_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_saldo_diciembre">
                                    <td class="border px-4 py-2">Saldo Mercado 31 Diciembre</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="saldo_diciembre_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="calculated-row" id="row_costo_venta">
                                    <td class="border px-4 py-2">Costo de Ventas</td>
                                    <td class="border px-4 py-2 font-bold" id="costo_venta_2024">0</td>
                                </tr>
                                <tr class="calculated-row bg-gray-100 dark:bg-gray-900" id="row_utilidad_bruta">
                                    <td class="border px-4 py-2 font-bold">Utilidad Bruta</td>
                                    <td class="border px-4 py-2 font-bold" id="utilidad_bruta_2024">0</td>
                                </tr>
                                <tr id="row_gastos_operacionales">
                                    <td class="border px-4 py-2">Gastos Operacionales</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="gastos_operacionales_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="calculated-row bg-gray-100 dark:bg-gray-900" id="row_utilidad_operacion">
                                    <td class="border px-4 py-2 font-bold">Utilidad de Operación</td>
                                    <td class="border px-4 py-2 font-bold" id="utilidad_operacion_2024">0</td>
                                </tr>
                                <tr id="row_gastos_financieros">
                                    <td class="border px-4 py-2">Gastos Financieros</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="gastos_financieros_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="calculated-row bg-gray-100 dark:bg-gray-900" id="row_utilidad_antes_impuestos">
                                    <td class="border px-4 py-2 font-bold">Utilidad antes de Impuestos</td>
                                    <td class="border px-4 py-2 font-bold" id="utilidad_antes_impuestos_2024">0</td>
                                </tr>
                                <tr id="row_impuesto_renta">
                                    <td class="border px-4 py-2">Impuesto a la Renta</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="impuesto_renta_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="calculated-row bg-gray-100 dark:bg-gray-900" id="row_utilidad_ejercicio">
                                    <td class="border px-4 py-2 font-bold">Utilidad de Ejercicio</td>
                                    <td class="border px-4 py-2 font-bold" id="utilidad_ejercicio_2024">0</td>
                                </tr>

                                <!-- Activo Corriente -->
                                <tr id="row_efectivo">
                                    <td class="border px-4 py-2" rowspan="5">Activo Corriente</td>
                                    <td class="border px-4 py-2">Efectivo y equivalente de efectivo</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="efectivo_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_inversiones_financieras">
                                    <td class="border px-4 py-2">Inversiones Financieras</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="inversiones_financieras_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_cuentas_por_cobrar">
                                    <td class="border px-4 py-2">Cuentas por cobrar Comerciales</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="cuentas_por_cobrar_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_mercaderias">
                                    <td class="border px-4 py-2">Mercaderias</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="mercaderias_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_servicios_pagados">
                                    <td class="border px-4 py-2">Servicios pagados por anticipado</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="servicios_pagados_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_activo_corriente">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Activo Corriente</td>
                                    <td class="border px-4 py-2 font-bold" id="total_activo_corriente_2024">0</td>
                                </tr>

                                <!-- Activo No Corriente -->
                                <tr id="row_terrenos">
                                    <td class="border px-4 py-2" rowspan="3">Activo No Corriente</td>
                                    <td class="border px-4 py-2">Terrenos</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="terrenos_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_edificaciones">
                                    <td class="border px-4 py-2">Edificaciones</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="edificaciones_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_muebles">
                                    <td class="border px-4 py-2">Muebles y enseres</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="muebles_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_activo_no_corriente">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Activo No Corriente</td>
                                    <td class="border px-4 py-2 font-bold" id="total_activo_no_corriente_2024">0</td>
                                </tr>

                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_activo">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Activo</td>
                                    <td class="border px-4 py-2 font-bold" id="total_activo_2024">0</td>
                                </tr>
                            
                                <!-- Pasivo Corriente -->
                                <tr id="row_tributos">
                                    <td class="border px-4 py-2" rowspan="4">Pasivo Corriente</td>
                                    <td class="border px-4 py-2">Tributos por pagar</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="tributos_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_cuentas_comerciales">
                                    <td class="border px-4 py-2">Cuentas por pagar Comerciales</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="cuentas_comerciales_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_obligaciones">
                                    <td class="border px-4 py-2">Obligaciones financieras</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="obligaciones_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_cuentas_diversas">
                                    <td class="border px-4 py-2">Cuentas por pagar diversas</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="cuentas_diversas_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo_corriente">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo Corriente</td>
                                    <td class="border px-4 py-2 font-bold" id="total_pasivo_corriente_2024">0</td>
                                </tr>
                                

                                <!-- Pasivo No Corriente -->
                                <tr id="row_obligaciones_largo_plazo">
                                    <td class="border px-4 py-2" rowspan="2">Pasivo No Corriente</td>
                                    <td class="border px-4 py-2">Obligaciones Financieras a Largo Plazo</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="obligaciones_largo_plazo_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_otros_pasivos">
                                    <td class="border px-4 py-2">Otros Pasivos</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="otros_pasivos_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo_no_corriente">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo No Corriente</td>
                                    <td class="border px-4 py-2 font-bold" id="total_pasivo_no_corriente_2024">0</td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo</td>
                                    <td class="border px-4 py-2 font-bold" id="total_pasivo_2024">0</td>
                                </tr>

                                <!-- Patrimonio -->
                                <tr id="row_capital_social">
                                    <td class="border px-4 py-2" rowspan="7">Patrimonio</td>
                                    <td class="border px-4 py-2">Capital Social</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="capital_social_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_beneficios">
                                    <td class="border px-4 py-2">Beneficios no realizados</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="beneficios_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_excedente">
                                    <td class="border px-4 py-2">Excedente de revaluación</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="excedente_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_reservas">
                                    <td class="border px-4 py-2">Reservas</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="reservas_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr id="row_utilidad_anterior">
                                    <td class="border px-4 py-2">Utilidad ejercicios anteriores</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="utilidad_anterior_2024" class="bg-transparent w-full px-2 py-1 border rounded-md" oninput="calcularTotales()">
                                    </td>
                                </tr>
                                <tr class="calculated-row" id="row_utilidad_ejercicio_patrimonio">
                                    <td class="border px-4 py-2">Utilidad del ejercicio</td>
                                    <td class="border px-4 py-2 font-bold" id="utilidad_ejercicio_patrimonio_2024">0</td>
                                </tr>

                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_patrimonio">
                                    <td class="border px-4 py-2 font-bold">Total Patrimonio</td>
                                    <td class="border px-4 py-2 font-bold" id="total_patrimonio_2024">0</td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-900" id="row_total_pasivo_patrimonio">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Total Pasivo y Patrimonio</td>
                                    <td class="border px-4 py-2 font-bold" id="total_pasivo_patrimonio_2024">0</td>
                                </tr>

                                <!-- Fila de Diferencia -->
                                <tr class="calculated-row bg-yellow-100 dark:bg-yellow-900" id="row_diferencia">
                                    <td class="border px-4 py-2 font-bold" colspan="2">Diferencia</td>
                                    <td class="border px-4 py-2 font-bold text-red-500" id="diferencia_2024">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        let years = [2024];

        function addYear() {
            let lastYear = years[years.length - 1];
            let newYear = lastYear - 1;
            years.push(newYear);
            addYearColumn(newYear);
        }

        function removeYear() {
            if (years.length > 1) {
                let removedYear = years.pop();
                removeYearColumn(removedYear);
            }
        }

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
                if (row.id === 'row_diferencia') {
                    // Añadir celda para la diferencia
                    let diffCell = document.createElement('td');
                    diffCell.className = 'border px-4 py-2 font-bold text-red-500';
                    diffCell.id = 'diferencia_' + year;
                    diffCell.innerText = '0';
                    row.appendChild(diffCell);
                } else if (row.id.startsWith('row_total') || row.classList.contains('calculated-row')) {
                    // Para filas de totales, añadir celda de total
                    let totalCell = document.createElement('td');
                    totalCell.className = 'border px-4 py-2 font-bold';
                    let totalId = row.id.substring(4) + '_' + year; // Eliminar 'row_' del id
                    totalCell.id = totalId;
                    totalCell.innerText = '0';
                    row.appendChild(totalCell);
                } else {
                    // Para filas de entrada, añadir celda con input
                    let cell = document.createElement('td');
                    cell.className = 'border px-4 py-2';
                    let input = document.createElement('input');
                    input.type = 'number';
                    let inputId = row.id.substring(4) + '_' + year; // Eliminar 'row_' del id
                    input.id = inputId;
                    input.className = 'bg-transparent w-full px-2 py-1 border rounded-md';
                    input.oninput = calcularTotales;
                    cell.appendChild(input);
                    row.appendChild(cell);
                }
            });
        }

        function removeYearColumn(year) {
            // Remover el encabezado
            let headerRow = document.querySelector('thead tr');
            let ths = headerRow.querySelectorAll('th');
            ths[ths.length - 1].remove();

            // Obtener todas las filas del tbody
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                if (row.id === 'row_diferencia') {
                    // Remover la celda de diferencia
                    let diffCells = row.querySelectorAll('td');
                    diffCells[diffCells.length - 1].remove();
                } else {
                    // Remover la última celda de cada fila
                    let tds = row.querySelectorAll('td');
                    tds[tds.length - 1].remove();
                }
            });
        }


        function calcularTotales() {
            years.forEach(function(year) {
                // Obtener valores de Activo Corriente
                const efectivo = parseFloat(document.getElementById('efectivo_' + year).value) || 0;
                const inversiones_financieras = parseFloat(document.getElementById('inversiones_financieras_' + year).value) || 0;
                const cuentas_por_cobrar = parseFloat(document.getElementById('cuentas_por_cobrar_' + year).value) || 0;
                const mercaderias = parseFloat(document.getElementById('mercaderias_' + year).value) || 0;
                const servicios_pagados = parseFloat(document.getElementById('servicios_pagados_' + year).value) || 0;

                // Total Activo Corriente
                const total_activo_corriente = efectivo + inversiones_financieras + cuentas_por_cobrar + mercaderias + servicios_pagados;
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
                const cuentas_comerciales = parseFloat(document.getElementById('cuentas_comerciales_' + year).value) || 0;
                const obligaciones = parseFloat(document.getElementById('obligaciones_' + year).value) || 0;
                const cuentas_diversas = parseFloat(document.getElementById('cuentas_diversas_' + year).value) || 0;

                // Total Pasivo Corriente
                const total_pasivo_corriente = tributos + cuentas_comerciales + obligaciones + cuentas_diversas;
                document.getElementById('total_pasivo_corriente_' + year).innerText = total_pasivo_corriente;

                // Obtener valores de Pasivo No Corriente
                const obligaciones_largo_plazo = parseFloat(document.getElementById('obligaciones_largo_plazo_' + year).value) || 0;
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
                const gastos_operacionales = parseFloat(document.getElementById('gastos_operacionales_' + year).value) || 0;
                const gastos_financieros = parseFloat(document.getElementById('gastos_financieros_' + year).value) || 0;
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
                const utilidad_anterior = parseFloat(document.getElementById('utilidad_anterior_' + year).value) || 0;

                // Total Patrimonio (incluyendo la utilidad del ejercicio calculada)
                const total_patrimonio = capital_social + beneficios + excedente + reservas + utilidad_anterior + utilidad_ejercicio;
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
    </script>

</x-app-layout>