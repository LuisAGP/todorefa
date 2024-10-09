<div id="controls-carousel" class="relative w-full md:py-3" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        @if (count($imagenes) == 1)
        <div class="hidden ease-in-out" data-carousel-item>
            <img src="{{ asset('uploads') }}/{{ $imagenes[0]->imagen }}" class="absolute block h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <div class="hidden ease-in-out" data-carousel-item>
            <img src="{{ asset('uploads') }}/{{ $imagenes[0]->imagen }}" class="absolute block h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        @elseif (count($imagenes) > 1)
        @foreach ($imagenes as $imagen)
            <div class="hidden ease-in-out" data-carousel-item>
                <img src="{{ asset('uploads') }}/{{ $imagen->imagen }}" class="absolute block h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        @endforeach
        @else
        <div class="ease-in-out h-full flex justify-center items-center" data-carousel-item>
            <h2 class="text-gray-400">¡No hay imagenes disponibles!</h2>
        </div>
        <div class="ease-in-outh-full flex justify-center items-center" data-carousel-item>
            <h2 class="text-gray-400">¡No hay imagenes disponibles!</h2>
        </div>
        @endif
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/50 dark:bg-gray-800/30 group-hover:bg-gray-100 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-gray-800 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/50 dark:bg-gray-800/30 group-hover:bg-gray-100 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-gray-800 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>