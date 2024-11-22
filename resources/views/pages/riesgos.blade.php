<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ratios Financieros') }}
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
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 text-white">
                    <!-- Introducción -->
                    <section id="introduccion" class="my-8">
                        <h2 class="text-3xl font-bold mb-4" style="color: #6875f5;">Cálculo e Interpretación de Ratios</h2>
                        <p class="mb-4">
                            Los ratios financieros son esenciales para evaluar la salud de una empresa, midiendo aspectos como liquidez, solvencia y rentabilidad. Su interpretación permite tomar decisiones informadas y mejorar la estabilidad y crecimiento del negocio.
                        </p>
                        <p class="mb-4">
                            Para la realización de los cálculos e interpretaciones, sírvase de completar los datos de las cuentas contables principales, a continuación haga click en confirmar.
                        </p>
                    </section>

                    {{-- Cuentas contables:
                        Liquidez
                        1- Activo corrientes
                        2- Pasivo corrientes
                        3- Inventarios
                        Gestión
                        4- Ventas netas
                        5- Promedio de activos
                        6- Ventas (Totales)
                        7- Activo Fijo neto
                        8- Capital de trabajo
                        Solvencia
                        9- Utilidad operativa
                        10- Gastos Financieros
                        11- patrimonio
                        12- Activo no corriente
                        Rentabilidad
                        13- Utilidad Neta
                        14- Costos de ventas

                        --}}


                    <!-- Tabla de Cuentas Contables -->
                    <section id="cuentas-contables" class="my-8">
                        <h3 class="text-2xl font-semibold mb-4">Cuentas Contables</h3>

                        <table class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Cuenta Contable</th>
                                    <th class="border px-4 py-2">Descripción</th>
                                    <th class="border px-4 py-2">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Activos y Pasivos -->
                                <tr>
                                    <td class="border px-4 py-2">Activo Corriente</td>
                                    <td class="border px-4 py-2">Total de activos corrientes</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="activo_corriente" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Pasivo Corriente</td>
                                    <td class="border px-4 py-2">Total de pasivos corrientes</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="pasivo_corriente" class="
                                         bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Activo No Corriente</td>
                                    <td class="border px-4 py-2">Total de activos no corrientes</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="activo_no_corriente" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Capital de Trabajo</td>
                                    <td class="border px-4 py-2">Activo Corriente - Pasivo Corriente</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="capital_trabajo" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Inventarios</td>
                                    <td class="border px-4 py-2">Inventarios</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="inventarios" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>

                                <!-- Gestión -->
                                <tr>
                                    <td class="border px-4 py-2">Ventas Netas</td>
                                    <td class="border px-4 py-2">Ingresos por ventas netas</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="ventas_netas" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Promedio de Activos</td>
                                    <td class="border px-4 py-2">Total de activos promedios</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="promedio_activos" class="
                                         bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Ventas Totales</td>
                                    <td class="border px-4 py-2">Ingresos por ventas totales</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="ventas_totales" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Activo Fijo Neto</td>
                                    <td class="border px-4 py-2">Total del activo fijo neto</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="activo_fijo_neto" class="
                                         bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>

                                <!-- Solvencia -->
                                <tr>
                                    <td class="border px-4 py-2">Utilidad Operativa</td>
                                    <td class="border px-4 py-2">Utilidad obtenida de las operaciones</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="utilidad_operativa" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Gastos Financieros</td>
                                    <td class="border px-4 py-2">Total de gastos financieros</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="gastos_financieros" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Patrimonio</td>
                                    <td class="border px-4 py-2">Total del patrimonio</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="patrimonio" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>

                                <!-- Rentabilidad -->
                                <tr>
                                    <td class="border px-4 py-2">Activo Real</td>
                                    <td class="border px-4 py-2">Total de activos reales</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="activo_real" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Pasivo</td>
                                    <td class="border px-4 py-2">Total de pasivos</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="pasivo" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Utilidad Neta</td>
                                    <td class="border px-4 py-2">Ganancia neta de la empresa</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="utilidad_neta" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Costos de Ventas</td>
                                    <td class="border px-4 py-2">Total de costos asociados a las ventas</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" id="costos_ventas" class="bg-transparent cuenta-input w-full px-2 py-1 border rounded-md" step="0.01" placeholder="Completa aquí..." required>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <div class="mt-6">
                            <button id="confirm-button" onclick="calcularRatios()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Calcular Ratios
                            </button>
                        </div>

                        <!-- Resultados -->
                        <div id="resultados" class="mt-8"></div>

                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        const button = document.getElementById('confirm-button');

        button.addEventListener('click', () => {
            console.log(button.classList);
            if(button.classList.contains('active')) {
                cerrarModal();
                button.classList.remove('active');
            }
            else{
                abrirModal();
                button.classList.add('active');
            }
        });
    </script>
    <script>
        const inputs = document.querySelectorAll('.cuenta-input');

        function calcularRatios() {
            console.log('Calculando...');
            const activoCorriente = parseFloat(document.getElementById('activo_corriente').value);
            const pasivoCorriente = parseFloat(document.getElementById('pasivo_corriente').value);
            const inventarios = parseFloat(document.getElementById('inventarios').value);
            const ventasNetas = parseFloat(document.getElementById('ventas_netas').value);
            const promedioActivos = parseFloat(document.getElementById('promedio_activos').value);
            const ventasTotales = parseFloat(document.getElementById('ventas_totales').value);
            const activoFijoNeto = parseFloat(document.getElementById('activo_fijo_neto').value);
            const utilidadOperativa = parseFloat(document.getElementById('utilidad_operativa').value);
            const gastosFinancieros = parseFloat(document.getElementById('gastos_financieros').value);
            const patrimonio = parseFloat(document.getElementById('patrimonio').value);
            const activoNoCorriente = parseFloat(document.getElementById('activo_no_corriente').value);
            const utilidadNeta = parseFloat(document.getElementById('utilidad_neta').value);
            const costoVentas = parseFloat(document.getElementById('costos_ventas').value);
            const activoReal = parseFloat(document.getElementById('activo_real').value);
            const pasivo = parseFloat(document.getElementById('pasivo').value);

            let contenidoCompleto = true;
            inputs.forEach(input => {
                if(input.value === '') {
                    contenidoCompleto = false;
                }
            });
            if(!contenidoCompleto){
                alert('Complete todos las cuentas contables.');
                return;
            }
            /*
                Cálculos de ratios (similar al código original)
            */
            const liquidezGeneral = activoCorriente / pasivoCorriente;
            const capitalDeTrabajo = activoCorriente - pasivoCorriente;
            const pruebaAcida = (activoCorriente - inventarios) / pasivoCorriente;
            const rotacionActivos = ventasNetas / promedioActivos;
            const rotacionActivoFijo = ventasTotales / activoFijoNeto;
            const rotacionCapitalTrabajo = ventasTotales / capitalDeTrabajo;
            const coberturaGastosInteres = utilidadOperativa / gastosFinancieros;
            const coberturaActivoNoCorriente = patrimonio / activoNoCorriente;
            const indiceDeSolvenciaTotal = activoReal / pasivo;
            const rentabilidadCapitalPropio = utilidadNeta / patrimonio;
            const rentabilidadMargenComercial = (ventasNetas - costoVentas) / ventasNetas;
            const rentabilidadNetaSobreLasVentas = utilidadNeta / ventasNetas;

            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = `
                <h3 class="text-xl font-bold mt-6">Resultados de los Ratios</h3>
                <p><strong>Liquidez General:</strong> ${liquidezGeneral.toFixed(2)}</p>
                <p><strong>Capital de Trabajo:</strong> ${capitalDeTrabajo.toFixed(2)}</p>
                <p><strong>Prueba Ácida:</strong> ${pruebaAcida.toFixed(2)}</p>
                <br/>
                <p><strong>Rotación de Activos:</strong> ${rotacionActivos.toFixed(2)}</p>
                <p><strong>Índice de Rotación de Activo Fijo:</strong> ${rotacionActivoFijo.toFixed(2)}</p>
                <p><strong>Índice de Rotación del Capital de Trabajo:</strong> ${rotacionCapitalTrabajo.toFixed(2)}</p>
                <br/>
                <p><strong>Cobertura de Gastos de Interés:</strong> ${coberturaGastosInteres.toFixed(2)}</p>
                <p><strong>Cobertura del Activo No Corriente:</strong> ${coberturaActivoNoCorriente.toFixed(2)}</p>
                <p><strong>Índice de solvencia Total:</strong> ${indiceDeSolvenciaTotal.toFixed(2)}</p>
                <br/>
                <p><strong>Rentabilidad sobre Capital Propio:</strong> ${rentabilidadCapitalPropio.toFixed(2)}</p>
                <p><strong>Rentabilidad Margen Comercial:</strong> ${rentabilidadMargenComercial.toFixed(2)}</p>
                <p><strong>Rentabilidad Neta sobre las Ventas:</strong> ${rentabilidadNetaSobreLasVentas.toFixed(2)}</p>
            `;

            // Transferir los resultados al textarea 'query' del modal
            const queryTextarea = document.getElementById('query');
            queryTextarea.value = resultadosDiv.textContent.trim();

            // Aquí agregamos el código para enviar automáticamente la consulta a GPT
            enviarConsultaGPT();
        }

        // Función que envía la consulta a GPT automáticamente
        function enviarConsultaGPT() {
            document.getElementById('response').setAttribute('placeholder', "Procesando su consulta...");
            let query = document.getElementById('query').value;

            fetch('{{ route('ask.gpt') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    query: query
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').value = data.response;
            })
            .catch(error => console.error('Error:', error));
        }

    </script>
</x-app-layout>
