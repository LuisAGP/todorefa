@extends('layouts.app')

@section('titulo')
    {{ $user->name }}
@endsection

@section('scripts')
@vite('resources/js/cuenta/domicilio.js')
@endsection

@section('breadcrumb')
<x-breadcrumb :rutas="[
    'inicio' => route('home'),
    'cuenta' => ''
]"/>
@endsection

@section('contenido')
<div class="p-3 md:flex md:gap-5 mt-3">
    
    <div class="sm:w-full md:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <h5 class="text-2xl mb-8 font-medium text-black dark:text-white">Información de cuenta</h5>

        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Email:</label>
            <input type="email" aria-label="disabled input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $user->email }}" disabled>
        </div>

        <form action="" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Nombre(s):</label>
                <input 
                    type="text" 
                    name="name" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    @if ( old('name') )
                    value="{{ old('name') }}"
                    @else
                    value="{{ $user->name }}"
                    @endif
                    >
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Apellidos:</label>
                <input 
                    type="text" 
                    name="lastname" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    @if ( old('lastname') )
                    value="{{ old('lastname') }}"
                    @else
                    value="{{ $user->lastname }}"
                    @endif
                    >
                @error('lastname')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="py-2 bg-sky-600 text-white text-center rounded w-full uppercase text-sm mt-3">Guardar</button>
        </form>
    </div>

    <div class="sm:w-full md:w-2/3 p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 md:mt-0 mt-5">
        <h5 class="text-2xl mb-8 font-medium text-black dark:text-white">Domicilios</h5>

        <div id="lista-domicilios" class="p-3 border border-gray-300">
            @if (isset($user->domicilios) && count($user->domicilios) > 0)
                @foreach ($user->domicilios as $domicilio)
                    <div class="border-b py-3 flex gap-1">
                        <div class="w-1/5">
                            <button 
                                    data-modal-target="modal-eliminarDomicilio" 
                                    data-modal-toggle="modal-eliminarDomicilio"
                                    data-adress="{{ $domicilio->domicilio_formateado() }}"
                                    data-id="{{ $domicilio->id }}"
                                    class="rounded p-1 bg-red-600 hover:bg-red-500 text-white"
                                    onclick="putInfoModal(this)"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>                               
                            </button>

                            <button
                                data-modal="modal-guardarDomicilio"
                                data-id="{{ $domicilio->id }}"
                                data-adress="{{ $domicilio->adress }}"
                                data-state_id="{{ $domicilio->state_id }}"
                                data-city_id="{{ $domicilio->city_id }}"
                                data-zip_code_id={{ $domicilio->zip_code_id }}
                                data-phone_number="{{ $domicilio->phone_number }}"
                                data-code="{{ $domicilio->zip_code->code }}"
                                data-selected="{{ $domicilio->selected }}"
                                class="rounded p-1 bg-green-500 hover:bg-green-400 text-white"
                                onclick="showModalDomicilio(this)"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                    <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-4/5">
                            {{ $domicilio->domicilio_formateado() }}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex justify-center items-center h-32">
                    <h2 class="text-lg text-gray-700">¡No hay domicilios registrados!</h2>
                </div>
            @endif
        </div>

        <button 
            onclick="showModalDomicilio(this)"
            class="p-1 bg-green-500 hover:bg-green-400 text-white rounded flex gap-1 items-center mt-5"
            >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                <path d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
            </svg>
            <span>+</span>
        </button>
    </div>
</div>

@include('cuenta.modal.modal-guardarDomicilio')
@include('cuenta.modal.modal-eliminarDomicilio')

@endsection