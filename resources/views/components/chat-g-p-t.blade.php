<div>
    <button id="compose-btn" class="z-50 bg-blue-500 text-white font-bold py-2 px-4 rounded fixed bottom-4 right-4 shadow-lg transition-all duration-300 hover:bg-blue-800 hover:-translate-y-1 dark:bg-blue-700 dark:hover:bg-blue-900">
        <i class="fa-solid fa-clipboard-question mr-2"></i>Realizar Consulta
    </button>

    <div id="compose-modal" class="transform transition-all duration-500 fixed z-50 bottom-0 right-0 translate-y-full bg-white border border-gray-300 shadow-lg p-4 rounded-lg w-4/5 md:w-1/2 xl:w-1/3 h-auto mr-4 dark:bg-gray-800 dark:border-gray-600 dark:shadow-gray-700">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold dark:text-white">Interpretación de los Ratios Obtenidos</h3>
            <button id="close-modal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">&times;</button>
        </div>
        <div class="mt-4">
            <label for="query" class="sr-only">Pregunta a Arnie</label>
            <div class="px-2 py-0 flex justify-end items-center">
                <label class="inline-flex items-center mb-5 cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    {{-- <span onclick="personalizarConsulta()" id="toggle-span" class="transition-colors duration-300 me-3 text-sm font-medium text-gray-800 dark:text-gray-500">Consulta personalizada</span>
                    <div onclick="personalizarConsulta()" id="toggle-button" class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white dark:after:bg-gray-800 after:border-gray-300 dark:after:border-gray-600 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600 dark:peer-checked:bg-blue-500"></div> --}}
                </label>
            </div>
            <div class="space-y-4">
                <textarea id="query" rows="3" class="hidden w-full resize-none border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 placeholder-gray-400 text-gray-900 sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200" readonly placeholder="Escribe tu consulta..."></textarea>

                {{-- <div class="flex justify-end">
                    <button id="send-btn"
                        class="inline-flex items-center rounded-md bg-indigo-600 dark:bg-indigo-500 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-500">
                        Enviar
                    </button>
                </div> --}}

                <label for="response" class="sr-only">GPT Response</label>
                <textarea id="response" rows="10" class="block w-full resize-none border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600  text-gray-900 sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:placeholder-gray-400" readonly placeholder="La respuesta aparecerá aquí..."></textarea>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModal() {
        document.getElementById('compose-modal').classList.remove('translate-y-full');
        document.getElementById('compose-modal').classList.add('mb-4');
    }

    function cerrarModal() {
        document.getElementById('compose-modal').classList.add('translate-y-full');
        document.getElementById('compose-modal').classList.remove('mb-4');
    }

    document.getElementById('compose-btn').addEventListener('click', () => {
        abrirModal();
    });

    document.getElementById('close-modal').addEventListener('click', () => {
        cerrarModal();
    });

    document.getElementById('send-btn').addEventListener('click', function() {
        document.getElementById('response').setAttribute('placeholder', "Procesando su consulta...");
        let query = document.getElementById('query').value;

        const divOptions = document.getElementById('query-options');
        const textQuery = document.getElementById('query');

        if (!textQuery.classList.contains('hidden') && query.trim() === '') {
           alert('El campo de consulta es requerido.');
           return;
        }
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
    });
    const toggleButton = document.getElementById('toggle-button');

    function personalizarConsulta() {
       const divOptions = document.getElementById('query-options');
       const TextQuery = document.getElementById('query');
       const span = document.getElementById('toggle-span');

       if(divOptions.classList.contains('hidden')) {
           divOptions.classList.remove('hidden');
           TextQuery.classList.add('hidden');
           span.classList.remove('dark:text-gray-200');
           span.classList.add('dark:text-gray-500');
       }else {
           if(TextQuery.classList.contains('hidden')) {
               TextQuery.classList.remove('hidden');
               divOptions.classList.add('hidden');
               span.classList.remove('dark:text-gray-500');
               span.classList.add('dark:text-gray-200');
           }
       }
    }
</script>
