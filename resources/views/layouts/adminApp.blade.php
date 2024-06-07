<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/admin.js')
</head>
<body class="bg-gray-100 lg:flex">
    
    <div class="lg:w-72">
        <header>
        
            <button
                type="button" 
                class="lg:hidden inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                onclick="openMenu();"
            >
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            
            <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-60 h-screen transition-transform lg:-translate-x-0 hide-menu">
                <div class="h-full px-3 overflow-y-auto bg-gray-800 dark:bg-gray-200">
                    <button
                        type="button" 
                        class="lg:hidden py-2 mt-2 ml-3 text-sm text-white rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        onclick="closeMenu();"
                    >
                        <span class="sr-only">Close sidebar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z" clip-rule="evenodd" />
                        </svg>  
                    </button>
                    <h1 class="text-center font-bold text-2xl mt-3">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo de TodoRefa" class="bg-white">
                        </a>
                    </h1>
                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex p-2 text-white rounded-lg dark:text-gray-200 hover:bg-gray-600 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-6 h-6 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-200 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.marcas') }}" class="flex p-2 text-white rounded-lg dark:text-gray-200 hover:bg-gray-600 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-6 h-6 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-200 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                                </svg>
                                <span class="ml-3">Marcas</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.modelos') }}" class="flex p-2 text-white rounded-lg dark:text-gray-200 hover:bg-gray-600 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-6 h-6 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-200 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V10.5z" clip-rule="evenodd" />
                                </svg>                                  
                                <span class="ml-3">Modelos</span>
                            </a>
                        </li>
                          
                        <li>
                            <a href="{{ route('admin.productos') }}" class="flex p-2 text-white rounded-lg dark:text-gray-200 hover:bg-gray-600 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-6 h-6 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-200 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.378 1.602a.75.75 0 00-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03zM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 00.372-.648V7.93zM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 00.372.648l8.628 5.033z" />
                                </svg>
                                <span class="ml-3">Productos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
        </header>
    </div>

    <main class="w-full h-full p-5">
        @yield('contenido')
    </main>

</body>
</html>