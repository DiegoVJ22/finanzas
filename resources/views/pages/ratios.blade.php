<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ratios de Rentabilidad') }}
        </h2>
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
        .result-section {
            margin-top: 20px;
            padding: 10px;
            background-color: dark:bg-gray-800;
        }
        .result-section h4 {
            margin-bottom: 10px;
        }
    </style>

    <div class="py-12 animate-fadeInUp">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 text-white">
                    <!-- Introducción -->
                    <section id="introduccion" class="my-8">
                        <h2 class="text-3xl font-bold mb-4" style="color: #6875f5;">Cálculo e Interpretación de Ratios</h2>
                        <p class="mb-4">
                            Los ratios de rentabilidad son cálculos matemáticos que nos ayudan a saber si una empresa está ganando lo suficiente como para cubrir sus gastos y generar beneficios.
                        </p>
                    </section>

                    <!-- Selector de períodos -->
                    <div class="my-6">
                        <label for="periodos" class="block text-sm font-medium mb-2">Selecciona un período:</label>
                        <form method="GET" action="{{ route('ratios') }}">
                            <select id="periodos" name="periodos" class="w-full md:w-1/2 p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" onchange="this.form.submit()">
                            <option value="" selected>Selecciones un Periodo</option>
                                @foreach($periodo as $p)
                                    <option value="{{ $p->año }}" {{ request('periodos') == $p->año ? 'selected' : '' }}>
                                        {{ $p->año }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Contenedor Grid para ROE y ROA -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sección para calcular ROE -->
                        <section id="calc-roe" class="my-4 bg-gray-900 p-4 rounded-lg">
                            <h3 class="text-2xl font-semibold mb-4 text-green-400">Calcular ROE (Return on Equity)</h3>
                            <label for="netIncome" class="block text-sm font-medium mb-2">Beneficios netos:</label>
                            @if($beneficio)
                                    <input value="{{ $utilidad_ejercicio }}" type="number" id="netIncome" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese ingresos netos">
                            @else
                                <input type="number" id="netIncome" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese ingresos netos">
                            @endif
                            <label for="equity" class="block text-sm font-medium mb-2">Patrimonio neto:</label>
                            @if($beneficio)
                                <input value="{{ $patrimonio->total_patrimonio }}" type="number" id="equity" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese patrimonio neto">
                            @else
                                <input type="number" id="equity" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese patrimonio neto">
                            @endif
                            <button onclick="calculateROE()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-2">
                                Calcular ROE
                            </button>

                            <div id="roeResult" class="result-section hidden">
                                <h4 class="text-lg font-bold">Resultado ROE:</h4>
                                <p id="roeValue"></p>
                                <p id="roeInterpretation"></p>
                            </div>
                        </section>

                        <section id="calc-roa" class="my-4 bg-gray-900 p-4 rounded-lg">
                            <h3 class="text-2xl font-semibold mb-4 text-orange-400">Calcular ROA (Return on Assets)</h3>
                            <label for="netIncomeROA" class="block text-sm font-medium mb-2">Beneficios netos:</label>
                            @if($beneficio)
                                <input value="{{ $utilidad_ejercicio }}" type="number" id="netIncomeROA" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese ingresos netos">
                            @else
                                <input type="number" id="netIncomeROA" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese ingresos netos">
                            @endif
                            <label for="totalAssets" class="block text-sm font-medium mb-2">Activos totales:</label>
                            @if($beneficio)
                            <input value="{{ $total_activo }}" type="number" id="totalAssets" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese activos totales">
                            @else
                                <input type="number" id="totalAssets" class="mb-4 w-full p-2 border rounded bg-gray-700 text-gray-200 placeholder-gray-400" placeholder="Ingrese activos totales">
                            @endif
                            <button onclick="calculateROA()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-2">
                                Calcular ROA
                            </button>

                            <div id="roaResult" class="result-section hidden">
                                <h4 class="text-lg font-bold">Resultado ROA:</h4>
                                <p id="roaValue"></p>
                                <p id="roaInterpretation"></p>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateROE() {
            const netIncome = parseFloat(document.getElementById('netIncome').value);
            const equity = parseFloat(document.getElementById('equity').value);

            if (!isNaN(netIncome) && !isNaN(equity) && equity !== 0) {
                const roe = (netIncome / equity) * 100;
                document.getElementById('roeValue').textContent = `ROE: ${roe.toFixed(2)}%`;
                document.getElementById('roeInterpretation').textContent = roe >= 15 
                    ? 'El ROE es alto, lo que indica una buena rentabilidad para los accionistas.' 
                    : 'El ROE es bajo, podría ser necesario mejorar la eficiencia o los ingresos.';
                document.getElementById('roeResult').classList.remove('hidden');
            } else {
                alert('Por favor, ingrese valores válidos para los cálculos.');
            }
        }

        function calculateROA() {
            const netIncome = parseFloat(document.getElementById('netIncomeROA').value);
            const totalAssets = parseFloat(document.getElementById('totalAssets').value);

            if (!isNaN(netIncome) && !isNaN(totalAssets) && totalAssets !== 0) {
                const roa = (netIncome / totalAssets) * 100;
                document.getElementById('roaValue').textContent = `ROA: ${roa.toFixed(2)}%`;
                document.getElementById('roaInterpretation').textContent = roa >= 5 
                    ? 'El ROA es aceptable, muestra un uso eficiente de los activos.' 
                    : 'El ROA es bajo, podría ser necesario optimizar el uso de los activos.';
                document.getElementById('roaResult').classList.remove('hidden');
            } else {
                alert('Por favor, ingrese valores válidos para los cálculos.');
            }
        }
    </script>
</x-app-layout>
