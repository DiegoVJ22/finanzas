<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Estrategias') }}
        </h2>
        <x-chat-g-p-t />
    </x-slot>
    {{-- <style>
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

        .card {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .card:nth-child(3) {
            animation-delay: 0.6s;
        }
    </style>

    <div class="py-12 animate-fadeInUp">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-gray-800 dark:bg-gray-800 dark:via-transparent border-b border-gray-200 dark:border-gray-700 text-white">

                    <section id="formulacion-estrategica" class="my-8">
                        <h2 class="text-3xl font-bold mb-4">Formulación Estratégica</h2>
                    </section>

                    <!-- Cards Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">
                        <!-- Card 1: Etapa de Entrada -->
                        <div class="card cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:bg-blue-500 bg-blue-900 p-6 rounded-lg shadow-md text-center"
                            onclick="openModal('modal-entrada')">
                            <div class="items-center justify-center">
                                <h4 class="text-2xl font-semibold text-white">
                                    <i class="fas fa-file-alt text-blue-400 text-2xl mr-4"></i>Etapa de Entrada
                                    (Insumos)
                                </h4>
                            </div>
                        </div>

                        <!-- Card 2: Etapa de Emparejamiento -->
                        <div class="card cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:bg-red-500 bg-red-900 p-6 rounded-lg shadow-md text-center"
                            onclick="openModal('modal-emparejamiento')">
                            <div class="items-center justify-center">
                                <h4 class="text-2xl font-semibold text-white">
                                    <i class="fas fa-project-diagram text-red-400 text-2xl mr-4"></i>Etapa de
                                    Emparejamiento
                                </h4>
                            </div>
                        </div>

                        <!-- Card 3: Etapa de Salida -->
                        <div class="card cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:bg-yellow-500 bg-yellow-900 p-6 rounded-lg shadow-md text-center"
                            onclick="openModal('modal-salida')">
                            <div class="items-center justify-center">
                                <h4 class="text-2xl font-semibold text-white">
                                    <i class="fas fa-check-circle text-yellow-400 text-2xl mr-4"></i>Etapa de Salida
                                    (Decisión)
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Modals -->
                    <!-- Modal 1: Etapa de Entrada -->
                    <div id="modal-entrada" class="fixed inset-0  items-center justify-center hidden z-50">
                        <div class="absolute inset-0 backdrop-blur-lg bg-opacity-50"></div>
                        <!-- Aplica el desenfoque al fondo -->
                        <div
                            class="relative bg-gray-800 top-1/2 -translate-y-1/2 p-8 rounded-lg shadow-2xl border border-gray-600 max-w-md mx-auto text-white transform transition-transform duration-500 scale-95 opacity-0">
                            <!-- Botón de Cerrar (X) -->
                            <button class="absolute top-2 right-2 text-white text-2xl"
                                onclick="closeModal('modal-entrada')">&times;</button>

                            <h2 class="text-2xl font-bold mb-4">Etapa de Entrada (Insumos)</h2>
                            <p class="mb-4">Esta etapa proporciona los insumos fundamentales para las siguientes
                                etapas del proceso estratégico. Incluye las siguientes matrices:</p>
                            <ul class="list-disc list-inside mb-4">
                                <li>Matriz de Evaluación de los Factores Externos (MEFE)</li>
                                <li>Matriz del Perfil Competitivo (MPC)</li>
                                <li>Matriz de Evaluación de los Factores Internos (MEFI)</li>
                                <li>Matriz de Intereses Organizacionales (MIO)</li>
                            </ul>
                            <div class="mb-4">
                                <img src="/img/etapa1.png" alt="Imagen de Etapa de Entrada"
                                    class="w-full rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>



                    <!-- Modal 2: Etapa de Emparejamiento -->
                    <div id="modal-emparejamiento" class="fixed inset-0  items-center justify-center hidden z-50">
                        <div class="absolute inset-0 backdrop-blur-lg bg-opacity-50"></div>
                        <!-- Aplica el desenfoque al fondo -->
                        <div
                            class="relative bg-gray-800 top-1/2 -translate-y-1/2 p-8 rounded-lg shadow-2xl border border-gray-600 max-w-md mx-auto text-white transform transition-transform duration-500 scale-95 opacity-0">
                            <!-- Botón de Cerrar (X) -->
                            <button class="absolute top-2 right-2 text-white text-2xl"
                                onclick="closeModal('modal-emparejamiento')">&times;</button>

                            <h2 class="text-2xl font-bold mb-4">Etapa de Emparejamiento (Combinación/Intuición)</h2>
                            <p class="mb-4">En esta etapa, se generan estrategias a través del emparejamiento de
                                recursos y habilidades internas con oportunidades y amenazas externas. Las matrices
                                utilizadas incluyen:</p>
                            <ul class="list-disc list-inside mb-4">
                                <li>Matriz de Fortalezas, Oportunidades, Debilidades y Amenazas (MFODA)</li>
                                <li>Matriz de la Posición Estratégica y Evaluación de la Acción (MPEYEA)</li>
                                <li>Matriz del Boston Consulting Group (MBCG)</li>
                                <li>Matriz Interna-Externa (MIE)</li>
                                <li>Matriz de la Gran Estrategia (MGE)</li>
                            </ul>
                            <div class="mb-4">
                                <img src="/img/etapa2.png" alt="Imagen de Etapa de Emparejamiento"
                                    class="w-full rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>

                    <!-- Modal 3: Etapa de Salida -->
                    <div id="modal-salida" class="fixed inset-0  items-center justify-center hidden z-50">
                        <div class="absolute inset-0 backdrop-blur-lg bg-opacity-50"></div>
                        <!-- Aplica el desenfoque al fondo -->
                        <div
                            class="relative bg-gray-800 top-1/2 -translate-y-1/2 p-8 rounded-lg shadow-2xl border border-gray-600 max-w-md mx-auto text-white transform transition-transform duration-500 scale-95 opacity-0">
                            <!-- Botón de Cerrar (X) -->
                            <button class="absolute top-2 right-2 text-white text-2xl"
                                onclick="closeModal('modal-salida')">&times;</button>

                            <h2 class="text-2xl font-bold mb-4">Etapa de Salida (Decisión)</h2>
                            <p class="mb-4">Esta etapa evalúa y selecciona las estrategias generadas en la etapa de
                                emparejamiento. Las decisiones se basan en las siguientes matrices:</p>
                            <ul class="list-disc list-inside mb-4">
                                <li>Matriz Decisión (MD)</li>
                                <li>Matriz Cuantitativa de Planeamiento Estratégico (MCPE)</li>
                                <li>Matriz de Rumelt (MR)</li>
                                <li>Matriz Ética (ME)</li>
                            </ul>
                            <div class="mb-4">
                                <img src="/img/etapa3.png" alt="Imagen de Etapa de Salida"
                                    class="w-full rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>

                    <br>

                    <!-- Elección de Estrategias -->
                    <section id="eleccion-estrategias" class="my-8">
                        <h2 class="text-3xl font-bold mb-4 animate-fadeInUp">Elección de Estrategias</h2>
                        <div class="bg-gray-800 shadow-md rounded p-6 mb-8 animate-fadeInUp">
                            <p class="mb-4">
                                La elección de estrategias es crucial y se apoya en la intuición y creatividad de los
                                gerentes. Utiliza cinco matrices clave para combinar y analizar los factores internos y
                                externos:
                            </p>
                            <ul class="list-disc list-inside mb-4">
                                <li>Matriz FODA</li>
                                <li>Matriz de la Posición Estratégica y Evaluación de la Acción (PEYEA)</li>
                                <li>Matriz del Boston Consulting Group (BCG)</li>
                                <li>Matriz Interna-Externa (IE)</li>
                                <li>Matriz de la Gran Estrategia (GE)</li>
                            </ul>
                            <p class="mb-4">
                                Aunque se utilizan herramientas y análisis, siempre hay incertidumbre, lo que requiere
                                un buen juicio intuitivo y experiencia en la toma de decisiones estratégicas.
                            </p>
                        </div>
                    </section>
                </div>
            </div>

            <section id="herramientas-estrategias" class="my-8 animate-fadeInUp">
                <h2 class="text-3xl font-bold mb-4" style="color: #6875f5;">Herramientas para la Generación y Elección
                    de Estrategias</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold mb-4 text-white">Matriz FODA</h4>
                        <img src="/img/images.png" alt="Ejemplo Matriz FODA"
                            class="rounded-lg shadow-md w-full h-48 object-cover cursor-pointer"
                            onclick="openImageModal(this)">
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold mb-4 text-white">Matriz Interna-Externa (IE)</h4>
                        <img src="/img/ie.webp" alt="Ejemplo Matriz IE"
                            class="rounded-lg shadow-md w-full h-48 object-cover cursor-pointer"
                            onclick="openImageModal(this)">
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold mb-4 text-white">Matriz de Decisión (MD)</h4>
                        <img src="/img/md.png" alt="Ejemplo Matriz MD"
                            class="rounded-lg shadow-md w-full h-48 object-cover cursor-pointer"
                            onclick="openImageModal(this)">
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold mb-4 text-white">Matriz de la Posición Estratégica y Evaluación
                            de la Acción (PEYEA)</h4>
                        <img src="/img/peyea.png" alt="Ejemplo Matriz PEYEA"
                            class="rounded-lg shadow-md w-full h-48 object-cover cursor-pointer"
                            onclick="openImageModal(this)">
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold mb-4 text-white">Matriz del Boston Consulting Group (BCG)</h4>
                        <img src="/img/bcg.webp" alt="Ejemplo Matriz BCG"
                            class="rounded-lg shadow-md w-full h-48 object-cover cursor-pointer"
                            onclick="openImageModal(this)">
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold mb-4 text-white">Matriz Cuantitativa de Planeamiento
                            Estratégico (MCPE)</h4>
                        <img src="/img/mcpe.png" alt="Ejemplo Matriz MCPE"
                            class="rounded-lg shadow-md w-full h-48 object-cover cursor-pointer"
                            onclick="openImageModal(this)">
                    </div>
                </div>
            </section>

            <!-- Modal para mostrar la imagen -->
            <div id="imageModal"
                class="fixed inset-0 hidden z-50  items-center justify-center bg-black bg-opacity-75">
                <div
                    class="max-w-lg relative bg-white top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 p-4 rounded-lg shadow-lg">
                    <button class="absolute top-2 right-2 text-black text-2xl"
                        onclick="closeImageModal()">&times;</button>
                    <img id="modalImage" src="" alt="Imagen ampliada"
                        class="rounded-lg shadow-md max-w-full h-auto mx-auto">
                </div>
            </div>

            <script>
                function openModal(modalId) {
                    const modal = document.getElementById(modalId);
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.querySelector('.transform').classList.add('scale-100');
                        modal.querySelector('.transform').classList.remove('scale-95');
                        modal.querySelector('.transform').classList.add('opacity-100');
                        modal.querySelector('.transform').classList.remove('opacity-0');
                    }, 50);
                }

                function closeModal(modalId) {
                    const modal = document.getElementById(modalId);
                    modal.querySelector('.transform').classList.remove('scale-100');
                    modal.querySelector('.transform').classList.add('scale-95');
                    modal.querySelector('.transform').classList.remove('opacity-100');
                    modal.querySelector('.transform').classList.add('opacity-0');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
                }

                function openImageModal(imgElement) {
                    const modal = document.getElementById('imageModal');
                    const modalImg = document.getElementById('modalImage');
                    modalImg.src = imgElement.src;
                    modal.classList.remove('hidden');
                }

                function closeImageModal() {
                    const modal = document.getElementById('imageModal');
                    modal.classList.add('hidden');
                }
            </script>

        </div>


    </div> --}}

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

        .card {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .card:nth-child(4) {
            animation-delay: 0.8s;
        }

        .card:nth-child(5) {
            animation-delay: 1s;
        }

        .card:nth-child(6) {
            animation-delay: 1.2s;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <section id="cards-section" class="my-8">
                        <div class="grid gap-6">
                            <!-- Card 1: FSC -->
                            <div class="card flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Factor Simple de Capitalización (FSC)</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Transformación de un Stock Inicial en un Stock Final
                                    </p>
                                    <form class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 grid-rows-7 md:grid-cols-4 md:grid-rows-3 gap-4">
                                            <div class="flex flex-col md:col-span-2">
                                                <label for="P1" class="text-gray-700 dark:text-gray-400">Valor Presente (P):</label>
                                                <input type="number" id="P1" name="P1" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-3">
                                                <label for="n1" class="text-gray-700 dark:text-gray-400">Período (n):</label>
                                                <input type="number" id="n1" name="n1" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-4 mt-4 md:mt-7">
                                                <select id="m1" name="m1" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Dias</option>
                                                    <option value="semanal">Semanas</option>
                                                    <option value="mensual">Meses</option>
                                                    <option value="bimestral">Bimestres</option>
                                                    <option value="trimestral">Trimestres</option>
                                                    <option value="semestral">Semestres</option>
                                                    <option value="anual" selected>Años</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:row-start-2">
                                                <label for="i1" class="text-gray-700 dark:text-gray-400">Tasa de Interés (i):</label>
                                                <input type="number" id="i1" name="i1" step="0.01" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:row-start-2 mt-4 md:mt-7">
                                                <select id="frecuencia1" name="frecuencia1" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:row-start-2">
                                                <label for="capitalizacion1" class="text-gray-700 dark:text-gray-400">Capitalización:</label>
                                                <select id="capitalizacion1" name="capitalizacion1" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>

                                            <div class="md:row-start-2"><button type="submit" class="mt-4 p-2 bg-indigo-600 text-white rounded w-full md:mt-7">Calcular</button></div>
                                            <div class="flex flex-col md:col-span-4">
                                                <label for="resultado1" class="text-gray-700 dark:text-gray-400">Resultado:</label>
                                                <input type="number" id="resultado1" name="resultado" class="mt-1 resultado p-2 border bg-white rounded" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Card 2: FSA -->
                            <div class="card flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Factor Simple de Actualización (FSA)</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Transformación de un Stock Final en un Stock Inicial
                                    </p>
                                    <form class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 grid-rows-7 md:grid-cols-4 md:grid-rows-3 gap-4">
                                            <div class="flex flex-col md:col-span-2">
                                                <label for="S2" class="text-gray-700 dark:text-gray-400">Valor Futuro (S):</label>
                                                <input type="number" id="S2" name="S2" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-3">
                                                <label for="n2" class="text-gray-700 dark:text-gray-400">Período (n):</label>
                                                <input type="number" id="n2" name="n2" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-4 mt-4 md:mt-7">
                                                <select id="m2" name="m2" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Dias</option>
                                                    <option value="semanal">Semanas</option>
                                                    <option value="mensual">Meses</option>
                                                    <option value="bimestral">Bimestres</option>
                                                    <option value="trimestral">Trimestres</option>
                                                    <option value="semestral">Semestres</option>
                                                    <option value="anual" selected>Años</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:row-start-2">
                                                <label for="i2" class="text-gray-700 dark:text-gray-400">Tasa de Interés (i):</label>
                                                <input type="number" id="i2" name="i2" step="0.01" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:row-start-2 mt-4 md:mt-7">
                                                <select id="frecuencia2" name="frecuencia2" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:row-start-2">
                                                <label for="capitalizacion2" class="text-gray-700 dark:text-gray-400">Capitalización:</label>
                                                <select id="capitalizacion2" name="capitalizacion2" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="md:row-start-2"><button type="submit" class="mt-4 p-2 bg-indigo-600 text-white rounded w-full md:mt-7">Calcular</button></div>
                                            <div class="flex flex-col md:col-span-4">
                                                <label for="resultado2" class="text-gray-700 dark:text-gray-400">Resultado:</label>
                                                <input type="number" id="resultado2" name="resultado2" class="mt-1 resultado p-2 border bg-white rounded" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Card 3: FRC -->
                            <div class="card flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Factor de Recuperación de Capital (FRC)</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Transformación de un Stock Inicial en un Flujo Constante
                                    </p>
                                    <form class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 grid-rows-7 md:grid-cols-4 md:grid-rows-3 gap-4">
                                            <div class="flex flex-col md:col-span-2">
                                                <label for="P3" class="text-gray-700 dark:text-gray-400">Valor Presente (P):</label>
                                                <input type="number" id="P3" name="P3" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-3">
                                                <label for="n3" class="text-gray-700 dark:text-gray-400">Período (n):</label>
                                                <input type="number" id="n3" name="n3" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-4 mt-4 md:mt-7">
                                                <select id="m3" name="m3" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Dias</option>
                                                    <option value="semanal">Semanas</option>
                                                    <option value="mensual">Meses</option>
                                                    <option value="bimestral">Bimestres</option>
                                                    <option value="trimestral">Trimestres</option>
                                                    <option value="semestral">Semestres</option>
                                                    <option value="anual" selected>Años</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:row-start-2">
                                                <label for="i3" class="text-gray-700 dark:text-gray-400">Tasa de Interés (i):</label>
                                                <input type="number" id="i3" name="i3" step="0.01" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:row-start-2 md:col-span-2 mt-4 md:mt-7">
                                                <select id="frecuencia3" name="frecuencia3" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            {{-- <div class="flex flex-col md:row-start-2">
                                                <label for="capitalizacion3" class="text-gray-700 dark:text-gray-400">Capitalización:</label>
                                                <select id="capitalizacion3" name="capitalizacion3" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div> --}}
                                            <div class="md:row-start-2"><button type="submit" class="mt-4 p-2 bg-indigo-600 text-white rounded w-full md:mt-7">Calcular</button></div>
                                            <div class="flex flex-col">
                                                <label for="l3" class="text-gray-700 dark:text-gray-400">Flujo:</label>
                                                <select id="l3" name="l3" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:col-span-3">
                                                <label for="resultado3" class="text-gray-700 dark:text-gray-400">Resultado:</label>
                                                <input type="number" id="resultado3" name="resultado3" class="mt-1 resultado p-2 border bg-white rounded" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Card 4: FAS -->
                            <div class="card flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Factor de Actualización de la Serie (FAS)</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Transformación de un Flujo Constante en un Stock Inicial
                                    </p>
                                    <form class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 grid-rows-7 md:grid-cols-4 md:grid-rows-3 gap-4">
                                            <div class="flex flex-col">
                                                <label for="R4" class="text-gray-700 dark:text-gray-400">Flujo Constante (R):</label>
                                                <input type="number" id="R4" name="R4" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col mt-4 md:mt-7">
                                                <select id="c4" name="c4" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="n4" class="text-gray-700 dark:text-gray-400">Período (n):</label>
                                                <input type="number" id="n4" name="n4" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col mt-4 md:mt-7">
                                                <select id="m4" name="m4" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Dias</option>
                                                    <option value="semanal">Semanas</option>
                                                    <option value="mensual">Meses</option>
                                                    <option value="bimestral">Bimestres</option>
                                                    <option value="trimestral">Trimestres</option>
                                                    <option value="semestral">Semestres</option>
                                                    <option value="anual" selected>Años</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="i4" class="text-gray-700 dark:text-gray-400">Tasa de Interés (i):</label>
                                                <input type="number" id="i4" name="i4" step="0.01" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-span-2 mt-4 md:mt-7">
                                                <select id="frecuencia4" name="frecuencia4" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            {{-- <div class="flex flex-col md:row-start-2">
                                                <label for="capitalizacion4" class="text-gray-700 dark:text-gray-400">Capitalización:</label>
                                                <select id="capitalizacion4" name="capitalizacion4" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div> --}}
                                            <div class="md:col-start-4"><button type="submit" class="mt-4 p-2 bg-indigo-600 text-white rounded w-full md:mt-7">Calcular</button></div>
                                            <div class="flex flex-col md:col-span-4">
                                                <label for="resultado4" class="text-gray-700 dark:text-gray-400">Resultado:</label>
                                                <input type="number" id="resultado4" name="resultado4" class="mt-1 resultado p-2 border bg-white rounded" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Card 5: FCS -->
                            <div class="card flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Factor de Capitalización de la Serie (FCS)</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Transformación de un Flujo Constante en un Stock Final
                                    </p>
                                    <form class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 grid-rows-7 md:grid-cols-4 md:grid-rows-3 gap-4">
                                            <div class="flex flex-col">
                                                <label for="R5" class="text-gray-700 dark:text-gray-400">Flujo Constante (R):</label>
                                                <input type="number" id="R5" name="R5" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col mt-4 md:mt-7">
                                                <select id="c5" name="c5" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="n5" class="text-gray-700 dark:text-gray-400">Período (n):</label>
                                                <input type="number" id="n5" name="n5" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col mt-4 md:mt-7">
                                                <select id="m5" name="m5" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Dias</option>
                                                    <option value="semanal">Semanas</option>
                                                    <option value="mensual">Meses</option>
                                                    <option value="bimestral">Bimestres</option>
                                                    <option value="trimestral">Trimestres</option>
                                                    <option value="semestral">Semestres</option>
                                                    <option value="anual" selected>Años</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="i5" class="text-gray-700 dark:text-gray-400">Tasa de Interés (i):</label>
                                                <input type="number" id="i5" name="i5" step="0.01" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-span-2 mt-4 md:mt-7">
                                                <select id="frecuencia5" name="frecuencia5" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            {{-- <div class="flex flex-col md:row-start-2">
                                                <label for="capitalizacion5" class="text-gray-700 dark:text-gray-400">Capitalización:</label>
                                                <select id="capitalizacion5" name="capitalizacion5" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div> --}}
                                            <div class="md:col-start-4"><button type="submit" class="mt-4 p-2 bg-indigo-600 text-white rounded w-full md:mt-7">Calcular</button></div>
                                            <div class="flex flex-col md:col-span-4">
                                                <label for="resultado5" class="text-gray-700 dark:text-gray-400">Resultado:</label>
                                                <input type="number" id="resultado5" name="resultado5" class="mt-1 resultado p-2 border bg-white rounded" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Card 6: FDFA -->
                            <div class="card flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Factor de Depósito del Fondo de Amortización (FDFA)</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Transformación de un Stock Final en un Flujo Constante
                                    </p>
                                    <form class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 grid-rows-7 md:grid-cols-4 md:grid-rows-3 gap-4">
                                            <div class="flex flex-col md:col-span-2">
                                                <label for="S6" class="text-gray-700 dark:text-gray-400">Valor Futuro (S):</label>
                                                <input type="number" id="S6" name="S6" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-3">
                                                <label for="n6" class="text-gray-700 dark:text-gray-400">Período (n):</label>
                                                <input type="number" id="n6" name="n6" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:col-start-4 mt-4 md:mt-7">
                                                <select id="m6" name="m6" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Dias</option>
                                                    <option value="semanal">Semanas</option>
                                                    <option value="mensual">Meses</option>
                                                    <option value="bimestral">Bimestres</option>
                                                    <option value="trimestral">Trimestres</option>
                                                    <option value="semestral">Semestres</option>
                                                    <option value="anual" selected>Años</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:row-start-2">
                                                <label for="i6" class="text-gray-700 dark:text-gray-400">Tasa de Interés (i):</label>
                                                <input type="number" id="i6" name="i6" step="0.01" class="mt-1 p-2 border border-gray-300 rounded" required>
                                            </div>
                                            <div class="flex flex-col md:row-start-2 md:col-span-2 mt-4 md:mt-7">
                                                <select id="frecuencia6" name="frecuencia6" class="p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            {{-- <div class="flex flex-col md:row-start-2">
                                                <label for="capitalizacion6" class="text-gray-700 dark:text-gray-400">Capitalización:</label>
                                                <select id="capitalizacion6" name="capitalizacion6" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div> --}}
                                            <div class="md:row-start-2"><button type="submit" class="mt-4 p-2 bg-indigo-600 text-white rounded w-full md:mt-7">Calcular</button></div>
                                            <div class="flex flex-col">
                                                <label for="l6" class="text-gray-700 dark:text-gray-400">Flujo:</label>
                                                <select id="l6" name="l6" class="mt-1 p-2 border border-gray-300 rounded" required>
                                                    <option value="diaria">Diaria</option>
                                                    <option value="semanal">Semanal</option>
                                                    <option value="mensual">Mensual</option>
                                                    <option value="bimestral">Bimestral</option>
                                                    <option value="trimestral">Trimestral</option>
                                                    <option value="semestral">Semestral</option>
                                                    <option value="anual" selected>Anual</option>
                                                </select>
                                            </div>
                                            <div class="flex flex-col md:col-span-3">
                                                <label for="resultado6" class="text-gray-700 dark:text-gray-400">Resultado:</label>
                                                <input type="number" id="resultado6" name="resultado6" class="mt-1 resultado p-2 border bg-white rounded" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/calculos.js')}}"></script>
    <script>
        const inputs = document.querySelectorAll('input');
        const selects = document.querySelectorAll('select');
        const options = document.querySelectorAll('option');
        const resultados = document.querySelectorAll('.resultado');
        inputs.forEach(element => {
            element.classList.add('bg-transparent');
            element.classList.add('text-white');
        });
        selects.forEach(element => {
            element.classList.add('bg-transparent');
            element.classList.add('text-white');
        });
        options.forEach(element => {
            element.classList.add('bg-gray-700');
        });
        resultados.forEach(element => {
            element.classList.remove('bg-white');
            element.classList.add('bg-gray-800');
            element.classList.add('text-white');
        });
    </script>

</x-app-layout>
