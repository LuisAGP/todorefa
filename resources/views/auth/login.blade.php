@extends('layouts.app')

@section('titulo')
Acceder
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 mt-10">

    <div class="sm:w-full md:w-2/3 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="">
            @csrf
            <legend class="text-gray-500 font-bold text-2xl text-center mb-5">Acceder</legend>

            @if (session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{ session('mensaje') }}
            </p>
            @endif

            <div class="mb-5">
                <input 
                    type="email" 
                    id='email' 
                    name="email" 
                    placeholder="Email" 
                    class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}"
                    
                >
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <input 
                    type="password" 
                    id='password' 
                    name="password" 
                    placeholder="Password" 
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <input type="checkbox" name="remember" id="remember"> 
                <label for="remember" class="mb-2 text-gray-500 text-sm">
                    Mantener mi sesión abierta
                </label>
            </div>

            <input 
                type="submit",
                value="Iniciar Sesión"
                class="bg-neutral-900 hover:bg-neutral-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            >
        </form>
        <p class="mt-3">
            <a href="{{ route('register') }}" class="text-sm underline text-red-500">¿No tienes cuenta?</a>
        </p>
        
    </div>
    
</div>
@endsection