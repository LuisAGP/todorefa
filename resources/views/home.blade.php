@extends('layouts.app')

@section('titulo')
Home
@endsection

@section('breadcrumb')
<x-breadcrumb :rutas="[
    'inicio' => '',
]"/>
@endsection

@section('contenido')
<form actiluis.lagp@outlook.comon="" method="GET" class="flex items-center justify-center gap-2 my-5">
    <input 
        type="search"
        name="search" 
        class="border p-1 sm:w-full lg:w-52 rounded-lg"
        placeholder="Buscar..."
        value="{{ isset($search) ? $search : '' }}"
    >

    <button type="submit" class="rounded bg-gray-800 hover:bg-gray-700 text-white p-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
        </svg>          
    </button>

</form>
<div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-1 mt-5">
    @foreach ($modelos as $modelo)
        <a href="{{ route('productosModelo', $modelo->id) }}" class="w-full aspect-square hover:bg-gray-200 rounded-md p-1">
            <img class="w-full" src="{{ asset('uploads/models') }}/{{ $modelo->image }}" alt="Imagen {{ $modelo->name }}">
            <p class="text-center text-gray-500 font-bold">{{ $modelo->brand->name }}</p>
            <p class="text-center"><small>{{ $modelo->name }}</small></p>
            <p class="text-center font-light"><small>{{ $modelo->getTotalProducts() != 1 ? $modelo->getTotalProducts()." refacciones": $modelo->getTotalProducts()." refacción"}}</small></p>
        </a>
    @endforeach
</div>
<div class="my-10">
    {{ $modelos->links('pagination::tailwind') }}
</div>
@endsection