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
                    <!-- Introducción -->
                    <section id="introduccion">
                        <h2 class="text-3xl font-bold mb-4" style="color: #6875f5;">NOF y FM
                        </h2>
                        {{-- <p class="mb-4">
                            Los ratios financieros son esenciales para evaluar la salud de una empresa, midiendo
                            aspectos como liquidez, solvencia y rentabilidad. Su interpretación permite tomar decisiones
                            informadas y mejorar la estabilidad y crecimiento del negocio.
                        </p> --}}
                    </section>

                    <section id="tabla-periodos" class="relative overflow-x-auto my-8">

                        {{-- <div class="flex justify-end gap-2 mb-4">
                            <button onclick="addYear()" class="px-4 py-2 bg-blue-500 text-white rounded">Agregar
                                Año</button>
                            <button onclick="removeYear()" class="px-4 py-2 bg-red-500 text-white rounded">Eliminar
                                Año</button>
                        </div> --}}

                        <!-- PERIODO DE MADURACIÓN CUENTAS POR COBRAR -->
                        <h3 class="text-2xl font-semibold mb-4">PERIODOS DE MADURACIÓN CUENTAS POR COBRAR</h3>
                        <table id="tabla_cuentas_por_cobrar"
                            class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Concepto</th>
                                    @foreach ($years as $year)
                                        <th class="border px-4 py-2">{{ $year }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Cuentas por cobrar diarias -->
                                <tr>
                                    <td class="border px-4 py-2">Cuentas por cobrar diarias</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="cxc_diarias_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['cxc_diarias'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Periodo promedio diario de cobro -->
                                <tr>
                                    <td class="border px-4 py-2">Periodo promedio diario de cobro</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="prom_cobro_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['prom_cobro'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Saldo NOF 1 -->
                                <tr class="bg-gray-100 dark:bg-gray-900">
                                    <td class="border px-4 py-2 font-bold">Saldo NOF 1</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2 font-bold" id="saldo_nof1_{{ $year }}">
                                            {{ number_format($data[$year]['calculations']['saldo_nof1'] ?? 0, 2, '.', '') }}
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Hoja de trabajo 1 -->
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2" colspan="{{ count($years) + 1 }}">Hoja de trabajo 1
                                    </th>
                                </tr>
                                <!-- Ventas -->
                                <tr>
                                    <td class="border px-4 py-2">Ventas</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="ventas_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['ventas'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Rotación de CXC -->
                                <tr>
                                    <td class="border px-4 py-2">Rotación de CXC</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="rotacion_cxc_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['rotacion_cxc'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                        <!-- PERIODO DE MADURACIÓN DE EXISTENCIAS -->
                        <h3 class="text-2xl font-semibold mb-4 my-10">PERIODOS DE MADURACIÓN DE EXISTENCIAS</h3>
                        <table id="tabla_existencias"
                            class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Concepto</th>
                                    @foreach ($years as $year)
                                        <th class="border px-4 py-2">{{ $year }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Inventario Diario -->
                                <tr>
                                    <td class="border px-4 py-2">Inventario Diario</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="inventario_diario_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['inventario_diario'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Periodo promedio diario de inventario -->
                                <tr>
                                    <td class="border px-4 py-2">Periodo promedio diario de inventario</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="prom_inv_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['prom_inv'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Saldo NOF 2 -->
                                <tr class="bg-gray-100 dark:bg-gray-900">
                                    <td class="border px-4 py-2 font-bold">Saldo NOF 2</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2 font-bold" id="saldo_nof2_{{ $year }}">
                                            {{ number_format($data[$year]['calculations']['saldo_nof2'] ?? 0, 2, '.', '') }}
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Hoja de trabajo 2 -->
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2" colspan="{{ count($years) + 1 }}">Hoja de trabajo 2
                                    </th>
                                </tr>
                                <!-- Costo de Ventas -->
                                <tr>
                                    <td class="border px-4 py-2">Costo de Ventas</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="costo_ventas_nof2_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['costo_ventas'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Rotación de Inventarios -->
                                <tr>
                                    <td class="border px-4 py-2">Rotación de Inventarios</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="rotacion_inv_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['rotacion_inv'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                        <!-- PERIODO DE MADURACIÓN DE CUENTAS POR PAGAR -->
                        <h3 class="text-2xl font-semibold mb-4 my-10">PERIODOS DE MADURACIÓN DE CUENTAS POR PAGAR</h3>
                        <table id="tabla_cuentas_por_pagar"
                            class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Concepto</th>
                                    @foreach ($years as $year)
                                        <th class="border px-4 py-2">{{ $year }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Cuentas por pagar diarias -->
                                <tr>
                                    <td class="border px-4 py-2">Cuentas por pagar diarias</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="cxp_diaria_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['cxp_diaria'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Periodo promedio diario de pago -->
                                <tr>
                                    <td class="border px-4 py-2">Periodo promedio diario de pago</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="prom_pago_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['prom_pago'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Saldo NOF 3 -->
                                <tr class="bg-gray-100 dark:bg-gray-900">
                                    <td class="border px-4 py-2 font-bold">Saldo NOF 3</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2 font-bold" id="saldo_nof3_{{ $year }}">
                                            {{ number_format($data[$year]['calculations']['saldo_nof3'] ?? 0, 2, '.', '') }}
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Hoja de trabajo 3 -->
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2" colspan="{{ count($years) + 1 }}">Hoja de trabajo 3
                                    </th>
                                </tr>
                                <!-- Costo de Ventas -->
                                <tr>
                                    <td class="border px-4 py-2">Costo de Ventas</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="costo_ventas_nof3_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['costo_ventas_cxp'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Rotación de cuentas por pagar -->
                                <tr>
                                    <td class="border px-4 py-2">Rotación de cuentas por pagar</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2">
                                            <input type="number" id="rotacion_cxp_{{ $year }}"
                                                class="bg-transparent w-full px-2 py-1 border rounded-md"
                                                oninput="calcularTotales()"
                                                value="{{ number_format($data[$year]['calculations']['rotacion_cxp'] ?? 0, 2, '.', '') }}">
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                        <!-- COMPARACIÓN -->
                        <h3 class="text-2xl font-semibold mb-4 my-10">COMPARACIÓN</h3>
                        <table id="tabla_comparacion"
                            class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Concepto</th>
                                    @foreach ($years as $year)
                                        <th class="border px-4 py-2">{{ $year }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <!-- NOF -->
                                <tr>
                                    <td class="border px-4 py-2">NOF</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2 font-bold" id="nof_{{ $year }}">
                                            {{ number_format($data[$year]['calculations']['nof'] ?? 0, 2, '.', '') }}
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- FM -->
                                <tr>
                                    <td class="border px-4 py-2">FM</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2 font-bold" id="fm_{{ $year }}">
                                            {{ number_format($data[$year]['calculations']['fm'] ?? 0, 2, '.', '') }}
                                        </td>
                                    @endforeach
                                </tr>
                                <!-- Ratio -->
                                <tr>
                                    <td class="border px-4 py-2">Ratio</td>
                                    @foreach ($years as $year)
                                        <td class="border px-4 py-2 font-bold" id="ratio_{{ $year }}">
                                            {{ number_format($data[$year]['calculations']['ratio'] ?? 0, 2, '.', '') }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicialización de las variables con datos del servidor
        let years = @json($years);
        let dataFromServer = @json($data);

        function addYear() {
            const lastYear = years[0]; // Tomamos el primer año (el más reciente)
            const newYear = lastYear - 1; // Agregamos un año anterior

            // Verificar si el año ya existe
            if (years.includes(newYear)) {
                alert('El año ' + newYear + ' ya está agregado.');
                return;
            }

            years.unshift(newYear); // Agregar el nuevo año al inicio del array

            // Agregar la columna en las tablas
            ['tabla_cuentas_por_cobrar', 'tabla_existencias', 'tabla_cuentas_por_pagar', 'tabla_comparacion'].forEach((
                id) => {
                const table = document.getElementById(id);

                // Agregar encabezado al inicio
                const headerRow = table.querySelector('thead tr');
                const th = document.createElement('th');
                th.className = 'border px-4 py-2';
                th.innerText = newYear;
                headerRow.insertBefore(th, headerRow.children[1]); // Insertar después de "Concepto"

                // Agregar columnas en las filas
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach((row) => {
                    if (row.querySelector('th')) {
                        // Actualizar el colspan de las filas con encabezados intermedios
                        const th = row.querySelector('th');
                        th.setAttribute('colspan', years.length + 1); // +1 por la columna de "Concepto"
                    } else {
                        const td = document.createElement('td');
                        td.className = 'border px-4 py-2';

                        // Para filas que contienen inputs
                        const existingInput = row.querySelector('input');
                        if (existingInput) {
                            // Obtener el ID base eliminando el año actual
                            const baseId = existingInput.id.substring(0, existingInput.id.lastIndexOf('_'));
                            const input = document.createElement('input');
                            input.type = 'number';
                            input.className = 'bg-transparent w-full px-2 py-1 border rounded-md';
                            input.id = `${baseId}_${newYear}`;
                            input.oninput = calcularTotales;

                            // Rellenar el valor si existe en dataFromServer
                            const fieldName = baseId.replace(/_\d+$/, '').replace(/_/g, ' ').trim();
                            const value = dataFromServer[newYear]?.calculations?.[baseId.replace(/_\d+$/,
                                '')] ?? '';
                            if (value !== '') {
                                input.value = parseFloat(value).toFixed(2);
                            }

                            td.appendChild(input);
                        } else {
                            // Para filas que contienen celdas de totales con IDs
                            const existingCell = row.querySelector(
                                `td[id$='_${years[1]}']`); // years[1] es el año siguiente
                            if (existingCell) {
                                // Obtener el ID base eliminando el año actual
                                const baseId = existingCell.id.substring(0, existingCell.id.lastIndexOf(
                                    '_'));
                                td.id = `${baseId}_${newYear}`;

                                // Rellenar el valor si existe en dataFromServer
                                const value = dataFromServer[newYear]?.calculations?.[baseId] ?? '0';
                                td.innerText = parseFloat(value).toFixed(2);
                            } else {
                                td.innerText = '0'; // Valor inicial para celdas sin IDs
                            }
                        }
                        row.insertBefore(td, row.children[1]); // Insertar después de "Concepto"
                    }
                });
            });

            calcularTotales();
        }

        function removeYear() {
            if (years.length > 1) {
                const removedYear = years.shift(); // Eliminar el primer año (el más antiguo)

                ['tabla_cuentas_por_cobrar', 'tabla_existencias', 'tabla_cuentas_por_pagar', 'tabla_comparacion'].forEach((
                    id) => {
                    const table = document.getElementById(id);

                    // Eliminar encabezado
                    const headerRow = table.querySelector('thead tr');
                    headerRow.removeChild(headerRow.children[
                        1]); // Eliminar el segundo elemento (primera columna de año)

                    // Eliminar columnas
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach((row) => {
                        if (row.querySelector('th')) {
                            // Actualizar el colspan de las filas con encabezados intermedios
                            const th = row.querySelector('th');
                            th.setAttribute('colspan', years.length + 1); // +1 por la columna de "Concepto"
                        } else {
                            row.removeChild(row.children[
                                1]); // Eliminar el segundo elemento (primera columna de año)
                        }
                    });
                });
            } else {
                alert('Debe haber al menos un año en la tabla.');
            }

            calcularTotales();
        }

        function calcularTotales() {
            years.forEach((year) => {
                // Saldo NOF 1
                const cxc_diarias = parseFloat(document.getElementById(`cxc_diarias_${year}`).value) || 0;
                const prom_cobro = parseFloat(document.getElementById(`prom_cobro_${year}`).value) || 0;
                const saldo_nof1 = cxc_diarias * prom_cobro;
                document.getElementById(`saldo_nof1_${year}`).innerText = saldo_nof1.toFixed(2);

                // Saldo NOF 2
                const inventario_diario = parseFloat(document.getElementById(`inventario_diario_${year}`).value) ||
                    0;
                const prom_inv = parseFloat(document.getElementById(`prom_inv_${year}`).value) || 0;
                const saldo_nof2 = inventario_diario * prom_inv;
                document.getElementById(`saldo_nof2_${year}`).innerText = saldo_nof2.toFixed(2);

                // Saldo NOF 3
                const cxp_diaria = parseFloat(document.getElementById(`cxp_diaria_${year}`).value) || 0;
                const prom_pago = parseFloat(document.getElementById(`prom_pago_${year}`).value) || 0;
                const saldo_nof3 = cxp_diaria * prom_pago;
                document.getElementById(`saldo_nof3_${year}`).innerText = saldo_nof3.toFixed(2);

                // NOF
                const nof = saldo_nof1 + saldo_nof2 - saldo_nof3;
                document.getElementById(`nof_${year}`).innerText = nof.toFixed(2);

                // FM
                const fmElement = document.getElementById(`fm_${year}`);
                const fm = parseFloat(fmElement.innerText) || 0;

                // Ratio (FM / NOF)
                const ratioElement = document.getElementById(`ratio_${year}`);
                if (nof !== 0) {
                    const ratio = fm / nof;
                    ratioElement.innerText = ratio.toFixed(2);
                } else {
                    ratioElement.innerText = '0';
                }
            });
        }

        // Ejecuta calcularTotales al cargar la página para inicializar los valores
        window.onload = function() {
            calcularTotales();
        };
    </script>


</x-app-layout>
