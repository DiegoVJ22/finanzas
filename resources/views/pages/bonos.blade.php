<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cálculo de Bonos') }}
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
    </style>

    <div class="py-12 animate-fadeInUp">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulario -->
                <form id="bonosForm" method="POST" action="{{ route('bonos.calcular') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Cupón -->
                        <div>
                            <label for="cupon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cupón (%)</label>
                            <input type="number" id="cupon" name="cupon" step="0.01" class="text-gray-200 mt-1 block w-full px-3 py-2 bg-transparent border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Ingrese el cupón" value="{{ old('cupon') }}" required>
                        </div>

                        <!-- Tasa de Rendimiento -->
                        <div>
                            <label for="tasa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tasa de Rendimiento (%)</label>
                            <input type="number" id="tasa" name="tasa" step="0.01" class="text-gray-200 mt-1 block w-full px-3 py-2 bg-transparent border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Ingrese la tasa de rendimiento" value="{{ old('tasa') }}" required>
                        </div>

                        <!-- Periodo -->
                        <div>
                            <label for="periodo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Periodo</label>
                            <select id="periodo" name="periodo" class="mt-1 block w-full px-3 py-2 bg-gray-800 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-300" required>
                                <option value="anual" {{ old('periodo') == 'anual' ? 'selected' : '' }}>Anual</option>
                                <option value="semestral" {{ old('periodo') == 'semestral' ? 'selected' : '' }}>Semestral</option>
                                <option value="trimestral" {{ old('periodo') == 'trimestral' ? 'selected' : '' }}>Trimestral</option>
                                <option value="mensual" {{ old('periodo') == 'mensual' ? 'selected' : '' }}>Mensual</option>
                            </select>
                        </div>

                        <!-- Valor Nominal -->
                        <div>
                            <label for="valor_nominal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor Nominal</label>
                            <input type="number" id="valor_nominal" name="valor_nominal" step="0.01" class="text-gray-200 mt-1 block w-full px-3 py-2 bg-transparent border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Ingrese el valor nominal del bono" value="{{ old('valor_nominal') }}" required>
                        </div>

                        <!-- Plazo -->
                        <div>
                            <label for="plazo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plazo (años)</label>
                            <input type="number" id="plazo" name="plazo" class="text-gray-200 mt-1 block w-full px-3 py-2 bg-transparent border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="{{ old('plazo') }}" required>
                        </div>
                    </div>

                    <!-- Botón Calcular -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-600 focus:outline-none">
                            Calcular Bono
                        </button>
                    </div>
                </form>

                <!-- Resultados -->
                @if (session('resultado'))
                    <div class="mt-8 bg-gray-100 dark:bg-gray-900 p-4 rounded-md">
                        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Resultados del Cálculo:</h3>
                        <p class="text-gray-700 dark:text-gray-300 mt-2">El precio del bono es: <span class="font-bold text-green-500">${{ session('resultado') }}</span></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
