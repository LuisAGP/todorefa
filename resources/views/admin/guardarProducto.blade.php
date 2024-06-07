@extends('layouts.adminApp')

@section('titulo')
{{ isset($product) ? $product->name : 'Nuevo Produto' }}
@endsection


@section('contenido')
<div class="sm:block md:flex justify-center">
    <div class="sm:w-full md:w-2/3 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('admin.productos.guardar') }}" enctype="multipart/form-data">
            @csrf
            <legend class="text-gray-800 font-bold text-2xl mb-8">Guardar Producto</legend>

            @if (session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{ session('mensaje') }}
            </p>
            @endif            

            <div class="mb-5">
                <label for="code" class="mb-2 block uppercase text-gray-500 font-normal">
                    Código de producto
                </label>
                <input 
                    type="text" 
                    id='code' 
                    name="code" 
                    class="border p-2 w-full rounded-lg @error('code') border-red-500 @enderror"
                    @if ( old('code') )
                    value="{{ old('code') }}"
                    @elseif (isset($product))
                    value="{{ $product->code }}"
                    @endif
                >
                @error('code')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="brand_id" class="mb-2 block uppercase text-gray-500 font-normal">
                    Marca
                </label>
                <select 
                    name="brand_id" 
                    id="brand_id"
                    class="border p-2 w-full rounded-lg @error('brand_id') border-red-500 @enderror"
                    data-url="{{ route('admin.obtenerModelos') }}"
                    onchange="getModels(this)"
                    required
                >
                    <option value="" disabled selected>--Selecciona una opción--</option>
                    @foreach ($marcas as $marca)
                        @if ( old('brand_id') == $marca->id)
                            <option value="{{ $marca->id }}" selected>{{ $marca->name }}</option>
                        @elseif (isset($product) && $product->brand_id == $marca->id)
                            <option value="{{ $marca->id }}" selected>{{ $marca->name }}</option>
                        @else
                            <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('brand_id')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="brand_model_id" class="mb-2 block uppercase text-gray-500 font-normal">
                    Modelo
                </label>
                <select 
                    name="brand_model_id" 
                    id="brand_model_id"
                    class="border p-2 w-full rounded-lg @error('brand_model_id') border-red-500 @enderror"
                    required
                >
                    @if (isset($product))
                        @foreach ($product->brand->models as $model)
                            @if ($product->brand_model_id == $model->id)
                                <option value="{{ $model->id }}" selected>{{ $model->name }}</option>
                            @else
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                @error('brand_model_id')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-normal">
                    Nombre
                </label>
                <input 
                    type="text" 
                    id='name' 
                    name="name" 
                    class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror"
                    @if ( old('name') )
                    value="{{ old('name') }}"
                    @elseif (isset($product))
                    value="{{ $product->name }}"
                    @endif
                >
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="description" class="mb-2 block uppercase text-gray-500 font-normal">
                    Descripción del producto
                </label>
                <textarea 
                    id="description"
                    name="description" 
                    class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror" 
                    rows="3"
                >@if ( old('description') ){{ old('description') }}@elseif (isset($product)){{ $product->description }}@endif</textarea>
                @error('description')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="precio_compra" class="mb-2 block uppercase text-gray-500 font-normal">
                    Precio de compra
                </label>
                <input 
                    type="number" 
                    min="0"
                    step="0.01"
                    id='precio_compra' 
                    name="precio_compra" 
                    class="border p-2 w-full rounded-lg @error('precio_compra') border-red-500 @enderror"
                    @if ( old('precio_compra') )
                    value="{{ old('precio_compra') }}"
                    @elseif (isset($product))
                    value="{{ $product->precio_compra }}"
                    @endif  
                >
                @error('precio_compra')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="precio_venta" class="mb-2 block uppercase text-gray-500 font-normal">
                    Precio de venta
                </label>
                <input 
                    type="number" 
                    min="0"
                    step="0.01"
                    id='precio_venta' 
                    name="precio_venta" 
                    class="border p-2 w-full rounded-lg @error('precio_venta') border-red-500 @enderror"
                    @if ( old('precio_venta') )
                    value="{{ old('precio_venta') }}"
                    @elseif (isset($product))
                    value="{{ $product->precio_venta }}"
                    @endif  
                >
                @error('precio_venta')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="stock" class="mb-2 block uppercase text-gray-500 font-normal">
                    Stock
                </label>
                <input 
                    min="0"
                    step="1"
                    type="number"
                    id='stock' 
                    name="stock" 
                    class="border p-2 w-full rounded-lg @error('stock') border-red-500 @enderror"
                    @if ( old('stock') )
                    value="{{ old('stock') }}"
                    @elseif (isset($product))
                    value="{{ $product->stock }}"
                    @endif
                >
                @error('stock')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="imagen_producto" class="mb-2 block uppercase text-gray-500 font-normal">
                    Imagenes
                </label>
                <input 
                    type="file" 
                    class="w-full rounded-lgclear" 
                    id="imagen_producto" 
                    name="imagen_producto[]" 
                    accept="image/*" 
                    multiple 
                    onchange="showPhotos(this);"
                >
                <div class="border mt-3 h-auto overflow-y-auto lg:columns-3 md:columns-2 sm:columns-1 gap-1" id="previewer"></div>

                @if (isset($product))
                <div class="mt-3">
                    <small class="rounded px-2 py-1 bg-green-500 text-white">Imagenes subidas</small>
                </div>
                <div class="border h-auto overflow-y-auto lg:columns-3 md:columns-2 sm:columns-1 gap-1" id="previewerUploaded">
                    @foreach ($product->images as $imagen)
                        <div class="position-relative" id="image-content-{{$imagen->id}}">
                            <img id="" src="{{ asset('uploads') }}/{{ $imagen->imagen }}" alt="Imagen {{ $product->name }}">
                            <div class="hover-content hidden-back" onmouseover="showBack(this)" onmouseout="hideBack(this)">
                                <button 
                                    type="button"
                                    class="rounded px-2 py-1 bg-red-500 hover:bg-red-600 text-white font-bold"
                                    data-modal-target="modal-eliminarProductoImagen" 
                                    data-modal-toggle="modal-eliminarProductoImagen" 
                                    data-id_imagen="{{ $imagen->id }}"
                                    onclick="putImageInfo(this)"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                
                @error('imagen_producto')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <input type="hidden" name="product_id" value="{{ isset($product) ? $product->id : '' }}">

            <input 
                type="submit",
                value="Guardar"
                class="bg-sky-600 hover:bg-sky-500 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            >
        </form>
    </div>
</div>
@if (isset($product))
@include('admin.modal.modal-eliminarProductoImagen')
@endif
@endsection
