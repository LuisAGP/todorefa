@extends('layouts.app')

@section('titulo')
    {{ $producto->name }}
@endsection

@section('scripts')
@vite('resources/js/producto/producto.js')

@endsection

@section('breadcrumb')
<x-breadcrumb :rutas="[
    'inicio' => route('home'),
    $producto->model->name => route('productosModelo', $producto->brand_model_id),
    $producto->code => ''
]"/>
@endsection

@section('contenido')
<div class="flex gap-5 md:gap-1 p-1 flex-col md:flex-row mt-5">

    <div class="md:w-3/5 sm:w-full">
        <x-image-viewer :imagenes="$producto->images" />
    </div>

    <div class="md:w-2/5 sm:w-full border border-gray-200 py-5 px-1 md:px-3 md:text-left text-center">
        <h1 class="text-2xl">{{ $producto->name }}</h1>
        <p class="text-5xl font-light mt-7">{{ $producto->get_precio_venta() }}</p>
        <p class="font-bold mt-7">Stock disponible: <span class=" text-gray-400"> ({{ $producto->stock }} @if ($producto->stock > 1) disponibles @else disponible @endif)</span></p>
        <form action="{{ route('order.index') }}" class="mt-3" id="form-producto">
            <div>
                <select name="stock" class="mt-2 mb-5 border border-gray-800 w-20">
                    @for ($i = 1; $i <= $producto->stock; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>

            <input type="hidden" name="id" value="{{ $producto->id }}">
            @auth

                <button 
                    class="p-3 bg-gray-800 text-white rounded-lg w-full font-bold block text-center"
                    type="submit"
                >Comprar</button>

                <button 
                    class="p-3 mt-3 bg-gray-300 rounded-lg text-gray-800 w-full font-bold block text-center" 
                    type="button"
                    data-url="{{ route('cart.guardarProducto') }}"
                    onclick="agregarCarrito(this)"
                >Agregar al carrito</button>
                
            @endauth
            @guest
                <a href="{{ route('register') }}" class="p-3 bg-gray-800 text-white rounded-lg w-full font-bold block text-center">Comprar</a>
                <a href="{{ route('register') }}" class="p-3 mt-3 bg-gray-300 rounded-lg text-gray-800 w-full font-bold block text-center">Agregar al carrito</a>
            @endguest
        </form>
    </div>

</div>

<div class="md:p-5 sm:p-3 mt-10">
    <h2 class="text-center font-light text-3xl uppercase my-5">Descripción</h2>
    <p class="py-10 px-5 bg-white rounded-xl">{!! $producto->html_description() !!}</p>
</div>
@endsection
