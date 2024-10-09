@extends('layouts.app')

@section('titulo')
Carrito - {{ auth()->user()->name }}
@endsection

@section('scripts')
@vite('resources/js/carrito/carrito.js')
@endsection

@section('breadcrumb')
<x-breadcrumb :rutas="[
    'inicio' => route('home'),
    'carrito' => ''
]"/>
@endsection

@section('contenido')
<h3 class="text-xl mt-10 font-bold">Tu carrito ({{ count($detallesCarrito) }}) artículos</h3>
<div class="p-3 md:p-2 overflow-y-auto h-5/6 md:flex gap-5">
    
    <div>
        @foreach ($detallesCarrito as $detalle)
            <div class="block sm:flex gap-5 w-full px-5 py-3 shadow-xl bg-white items-center mb-3 font-light">
                <div class="sm:w-5/12 w-full mb-3 text-center sm:text-left">
                    <a href="{{ route('detalleProducto', $detalle->product->id) }}" class="w-full aspect-square hover:text-sky-600 rounded-md p-3">
                        <p>{{ $detalle->product->name }}</p>
                    </a>
                </div>
                <div class="sm:w-2/12 w-full mb-3 flex justify-center">
                    <img class="w-32" src="{{ asset('/') }}/{{$detalle->product->imagenPortada()}}" alt="{{$detalle->product->name}}">
                </div>
                <div class="sm:w-2/12 w-full mb-3 text-center">
                    <select 
                        data-id="{{$detalle->id}}"
                        data-url="{{ route('cart.actualizarStock', $detalle) }}"
                        onchange="updateStock(this)"
                        >
                        @for ($i = 1; $i <= $detalle->product->stock; $i++)
                            @if ($i == $detalle->stock)
                                <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                </div>
                <div class="sm:w-2/12 w-full mb-3 text-center">
                    <p id="total-producto-{{ $detalle->id }}">{{ $detalle->get_total() }}</p>
                </div>
                <div class="sm:w-1/12 w-full mb-3">
                    <button
                        data-modal-target="modal-eliminarProductoCarrito" 
                        data-modal-toggle="modal-eliminarProductoCarrito"
                        data-action="{{ route('cart.eliminarProducto', $detalle) }}"
                        data-name="{{ $detalle->product->name }}"
                        class="w-full rounded p-1 bg-red-600 hover:bg-red-500 text-white flex justify-center"
                        onclick="putInfoModal(this)"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                        </svg>                      
                    </button>
                </div>
            </div>
        @endforeach
    </div>


    @if (count($detallesCarrito) > 0)
        <div class="shadow-2xl bg-white p-10 md:w-1/3 w-full flex flex-col justify-between h-72">
            <h4 class="mb-4 text-gray-800">Resumen del pedido</h4>
            <table class="w-full text-sm text-gray-500 dark:text-gray-400 mb-5">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 text-left">
                            Subtotal
                        </td>
                        <td class="py-1 text-right" id="subtotal-carrito">
                            {{ $subtotal }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 text-left">
                            Iva
                        </td>
                        <td class="py-1 text-right" id="iva-carrito">
                            {{ $iva }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 text-left">
                            Total
                        </td>
                        <td class="py-1 text-right" id="total-carrito">
                            {{ $total }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-5">
                <form action="{{ route('order.index') }}">
                    <button type="submit" class="text-center bg-sky-600 text-white py-3 rounded w-full">
                        <strong>COMPRAR</strong>
                    </button>
                </form>
            </div>
        </div>
    @endif

</div>

@if (count($detallesCarrito) > 0)
    @include('carrito.modal.modal-eliminarProductoCarrito')
@endif
@endsection