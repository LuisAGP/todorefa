<!-- Main modal -->
<div id="modal-guardarModelo" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Guardar Modelo
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-guardarModelo">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('admin.guardarModelo') }}" method="POST" id="form-guardarModelo" enctype="multipart/form-data">@csrf
                <!-- Modal body -->
                <div class="p-6 space-y-6">

                    <div class="mb-5">
                        <label for="brand" class="mb-2 block uppercase text-gray-500 font-normal">
                            Marca
                        </label>
                        <select 
                            name="brand_id" 
                            id="modal-guardarModelo-brand_id" 
                            class="border p-2 w-full rounded-lg" 
                            required
                        >
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="name" class="mb-2 block uppercase text-gray-500 font-normal">
                            Nombre
                        </label>
                        <input 
                            type="text" 
                            id='modal-guardarModelo-name' 
                            name="name" 
                            class="border p-2 w-full rounded-lg"
                            required
                        >
                    </div>

                    <div class="mb-5">
                        <label for="brand" class="mb-2 block uppercase text-gray-500 font-normal">
                            Imagen
                        </label>
                        <input 
                            type="file" 
                            name="image"
                            id="modal-guardarModelo-image"
                            class="border w-full rounded-lg"
                            onchange="showPhotos(this);"
                        >
                        <div class="border mt-3 h-auto overflow-y-auto columns-1 gap-1 text-center" id="previewer"></div>
                    </div>

                </div>
                <input type="hidden" name="id" id="modal-guardarModelo-id">
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">    
                    <button 
                        data-modal-hide="modal-guardarModelo" 
                        type="submit" 
                        class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800"
                    >
                        Guardar
                    </button>
                    <button data-modal-hide="modal-guardarModelo" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>