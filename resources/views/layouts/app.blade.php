<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoRefa | @yield('titulo')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @yield('scripts')
    @yield('style')

</head>
<body class="bg-white lg:flex">
    
    <x-navbar />

    <div class="w-full h-full p-5">
        <main>
            @yield('breadcrumb')
            @yield('contenido')
        </main>

        <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
            TodoRefa - Todos los derechos reservados {{ date('Y') }}
        </footer>
    </div>

    @include('modal.alert')
</body>
</html>