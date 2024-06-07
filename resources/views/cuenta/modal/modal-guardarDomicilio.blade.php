<!-- Main modal -->
<div 
    id="modal-guardarDomicilio" 
    tabindex="-1" 
    aria-hidden="true" 
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Guardar Domicilio
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="modalDomicilio.hide();">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form 
                action="" 
                method="POST" 
                id="form-guardarDomicilio"
                data-url="{{ route('profile.guardarDomicilioUsuario') }}"
                onsubmit="return guardarDomicilioUsuario(this)"
            >@csrf
                <!-- Modal body -->
                <div class="p-6 space-y-3">
                    <div>
                        <label for="adress" class="mb-1 block text-gray-500 font-normal">
                            Calle y Número:
                        </label>
                        <input 
                            type="text"
                            name="adress" 
                            id='modal-guardarDomicilio-adress' 
                            class="border w-full rounded-lg"
                            required
                        >
                    </div>
                    <div>
                        <label for="adress" class="mb-1 block text-gray-500 font-normal">
                            Teléfono:
                        </label>
                        <input 
                            type="number"
                            step="1"
                            min="1000000000"
                            max="9999999999"
                            name="phone_number" 
                            id='modal-guardarDomicilio-phone_number' 
                            class="border w-full rounded-lg"
                            {{-- required --}}
                        >
                    </div>
                    <div>
                        <label for="code" class="mb-1 block text-gray-500 font-normal">
                            Codígo Postal:
                        </label>
                        <input 
                            type="text"
                            id='modal-guardarDomicilio-code' 
                            name="code" 
                            class="border w-full rounded-lg"
                            data-url={{ route('profile.obtenerUbicacion') }}
                            onkeyup="obtenerZipCode(this)"
                            required
                        >
                    </div>
                    <div>
                        <label for="state_id" class="mb-1 block text-gray-500 font-normal">
                            Estado:
                        </label>
                        <select 
                            name="state_id" 
                            id="modal-guardarDomicilio-state_id"
                            class="border w-full rounded-lg"
                            required
                        ></select>
                    </div>
                    <div>
                        <label for="city_id" class="mb-1 block text-gray-500 font-normal">
                            Municipio:
                        </label>
                        <select 
                            name="city_id" 
                            id="modal-guardarDomicilio-city_id"
                            class="border w-full rounded-lg"
                            required
                        ></select>
                    </div>
                    <div>
                        <label for="zip_code_id" class="mb-1 block text-gray-500 font-normal">
                            Colonia:
                        </label>
                        <select 
                            name="zip_code_id" 
                            id="modal-guardarDomicilio-zip_code_id"
                            class="border w-full rounded-lg"
                            required
                        ></select>
                    </div>
                    <div>
                        <label for="zip_code_id" class="mb-1 block text-gray-500 font-normal">
                            ¿Seleccionar como predeterminado?:
                        </label>
                        <select 
                            name="selected" 
                            id="modal-guardarDomicilio-selected"
                            class="border w-full rounded-lg"
                            required
                        >
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" id="modal-guardarDomicilio-id">
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">    
                    <button 
                        type="submit" 
                        class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800"
                    >
                        Guardar
                    </button>
                    <button onclick="modalDomicilio.hide();" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>