<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('WACC') }}
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
                    <h3 class="text-xl font-semibold pb-4">Cálculo del WACC</h3>
                    <form action="{{ route('wacc.calcular') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-4 grid-rows-5 gap-4">
                            <div class="col-span-2">
                                <label for="rf" class="text-gray-400 block">Tasa Libre de riesgo</label>
                                <input type="number" step="0.01" id="rf" name="rf"
                                    class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                            </div>
                            <div class="col-span-2 col-start-1 row-start-2">
                                <label for="beta" class="text-gray-400 block">Beta desapalancado</label>
                                <input type="number" step="0.01" id="beta" name="beta"
                                    class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                            </div>
                            <div class="col-span-2 col-start-3 row-start-1">
                                <label for="year" class="text-gray-400 block">Año</label>
                                <select name="year" id="year"
                                    class="w-full bg-transparent p-2 border border-gray-500 rounded">
                                    @foreach ($years as $year)
                                        <option class="bg-gray-800" value="{{ $year }}">{{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2 col-start-3 row-start-2">
                                <label for="rm" class="text-gray-400 block">S&P 500</label>
                                <input type="number" step="0.01" id="rm" name="rm"
                                    class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                            </div>
                            <div class="col-span-2 row-start-3">
                                <div class="grid grid-cols-2 grid-rows-1 gap-4">
                                    <div>
                                        <label for="i1" class="text-gray-400 block">Tasa del Pasivo a CORTO
                                            PLAZO</label>
                                        <input type="number" step="0.01" id="i1" name="i1"
                                            class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                                    </div>
                                    <div>
                                        <label for="frecuencia1" class="text-gray-400 block">Frecuencia</label>
                                        <select id="frecuencia1" name="frecuencia1"
                                            class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                                            <option class="bg-gray-800" value="diaria">Diaria</option>
                                            <option class="bg-gray-800" value="semanal">Semanal</option>
                                            <option class="bg-gray-800" value="mensual">Mensual</option>
                                            <option class="bg-gray-800" value="bimestral">Bimestral</option>
                                            <option class="bg-gray-800" value="trimestral">Trimestral</option>
                                            <option class="bg-gray-800" value="semestral">Semestral</option>
                                            <option class="bg-gray-800" value="anual" selected>Anual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 col-start-3 row-start-3">
                                <div class="grid grid-cols-2 grid-rows-1 gap-4">
                                    <div>
                                        <label for="i2" class="text-gray-400 block">Tasa del Pasivo a LARGO
                                            PLAZO</label>
                                        <input type="number" step="0.01" id="i2" name="i2"
                                            class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                                    </div>
                                    <div>
                                        <label for="frecuencia2" class="text-gray-400 block">Frecuencia</label>
                                        <select id="frecuencia2" name="frecuencia2"
                                            class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                                            <option class="bg-gray-800" value="diaria">Diaria</option>
                                            <option class="bg-gray-800" value="semanal">Semanal</option>
                                            <option class="bg-gray-800" value="mensual">Mensual</option>
                                            <option class="bg-gray-800" value="bimestral">Bimestral</option>
                                            <option class="bg-gray-800" value="trimestral">Trimestral</option>
                                            <option class="bg-gray-800" value="semestral">Semestral</option>
                                            <option class="bg-gray-800" value="anual" selected>Anual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 row-start-4">
                                <label for="riesgo-pais" class="text-gray-400 block">Riesgo País</label>
                                <input type="number" step="0.01" id="riesgo-pais" name="riesgo-pais"
                                    class="w-full bg-transparent p-2 border border-gray-500 rounded" required>
                            </div>
                            <div class="col-span-2 col-start-3 row-start-4">
                                <button type="submit"
                                    class="mt-6 p-2 bg-indigo-600 text-white rounded w-full">Calcular</button>
                            </div>
                        </div>
                    </form>
                    @if (isset($total_activo, $total_pasivo_corriente, $total_pasivo_no_corriente))
                        <h3 class="text-xl font-semibold pb-4">Resumen de Cuentas contables</h3>
                        <table class="w-full mx-auto text-center">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Año</th>
                                    <th class="border px-4 py-2">Cuenta</th>
                                    <th class="border px-4 py-2">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2" rowspan="6">{{ $data_year }}</td>
                                    <td class="border px-4 py-2 capitalize">pasivo corriente</td>
                                    <td class="border px-4 py-2">{{ $total_pasivo_corriente }}</td>
                                </tr>
                                <tr>
                                    {{-- <td class="border px-4 py-2" rowspan="3">{{$data_year}}</td> --}}
                                    <td class="border px-4 py-2 capitalize">pasivo no corriente</td>
                                    <td class="border px-4 py-2">{{ $total_pasivo_no_corriente }}</td>
                                </tr>
                                <tr class="bg-gray-900">
                                    {{-- <td class="border px-4 py-2" rowspan="3">{{$data_year}}</td> --}}
                                    <td class="border px-4 py-2 capitalize">total pasivo</td>
                                    <td class="border px-4 py-2">
                                        {{ $total_pasivo_no_corriente + $total_pasivo_corriente }}</td>
                                </tr>
                                <tr>
                                    {{-- <td class="border px-4 py-2" rowspan="3">{{$data_year}}</td> --}}
                                    <td class="border px-4 py-2 capitalize">patrimonio</td>
                                    <td class="border px-4 py-2 capitalize">{{ $total_patrimonio }}</td>
                                </tr>
                                <tr class="bg-gray-900">
                                    {{-- <td class="border px-4 py-2" rowspan="3">{{$data_year}}</td> --}}
                                    <td class="border px-4 py-2 capitalize">pasivo y patrimonio</td>
                                    <td class="border px-4 py-2">
                                        {{ $total_pasivo_no_corriente + $total_pasivo_corriente + $total_patrimonio }}
                                    </td>
                                </tr>
                                <tr>
                                    {{-- <td class="border px-4 py-2" rowspan="3">{{$data_year}}</td> --}}
                                    <td class="border px-4 py-2 capitalize">total activo</td>
                                    <td class="border px-4 py-2 capitalize">{{ $total_activo }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    @if (isset($wacc))
                        <h3 class="text-xl font-semibold pb-4 mt-4">Resultado</h3>
                        <table class="w-full mx-auto text-center">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Año</th>
                                    <th class="border px-4 py-2">WACC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">{{ $data_year }}</td>
                                    <td class="border px-4 py-2">{{ $wacc }}%</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
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
                    message = 'El balance no está balanceado para el año ' + year + '.';
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
    </script> --}}

</x-app-layout>
