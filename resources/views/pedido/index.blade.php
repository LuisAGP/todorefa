@extends('layouts.app')

@php
    
    // SDK de Mercado Pago
    use MercadoPago\MercadoPagoConfig;
    use MercadoPago\Client\Preference\PreferenceClient;

    // Agrega credenciales
    MercadoPagoConfig::setAccessToken("APP_USR-6581082970951905-102919-533e9f2f872ede0d461c1a4008b73167-1529571802");

    $items = [];

    foreach ($productos as $key => $value) {

        $items[] = [
            "title" => $value->producto->name,
            "quantity" => $value->stock,
            "currency_id" => "MXN",
            "unit_price" => (float) $value->producto->precio_venta
        ];
        
    }
   
    $client = new PreferenceClient();

    $preference = $client->create([
        "items" => $items,
        "back_urls" => [
            "success" => route('order.generateOrder'),
            "failure" => '#',
            "pending" => '#'
        ],
        "auto_return" => 'approved',
    ]);

@endphp

@section('titulo')
Realizar pedido
@endsection

@section('breadcrumb')
@if (isset($request->id))
    <x-breadcrumb :rutas="[
        'inicio' => route('home'),
        $productos[0]->producto->model->name => route('productosModelo', $productos[0]->producto->brand_model_id),
        $productos[0]->producto->code => route('detalleProducto', $productos[0]->producto->id),
        'Realizar pedido' => ''
    ]"/>
@else
    <x-breadcrumb :rutas="[
        'inicio' => route('home'),
        'carrito' => route('cart.carrito'),
        'Realizar pedido' => ''
    ]"/>
@endif
@endsection

@section('contenido')
<div class="p-3 md:flex md:gap-5 m-3">

    <div class="sm:w-full md:w-2/3 mb-5">

        <div class="mb-5 p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg mb-4 font-medium text-gray-600 dark:text-white">Domicilio:</h5>
            <select id="" class="border w-full rounded-lg">
                @foreach (auth()->user()->domicilios as $domicilio)
                    <option 
                        value="{{ $domicilio->id }}"
                        @if ($domicilio->selected == 1)
                            selected
                        @endif
                    >{{ $domicilio->domicilio_formateado() }}</option>
                @endforeach
            </select>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg mb-4 font-medium text-gray-600 dark:text-white">Detalles del pedido:</h5>

            <table class="w-full text-sm text-gray-500 dark:text-gray-400 mb-8">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="py-3">
                            Producto
                        </th>
                        <th scope="col" class="py-3">
                            Cantidad
                        </th>
                        <th scope="col" class="py-3">
                            Precio
                        </th>
                        <th scope="col" class="py-3">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $detalles)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium dark:text-white text-left w-1/2">
                            {{ $detalles->producto->name }}
                        </th>
                        <td class="py-4 text-center">
                            {{ $detalles->stock }}
                        </td>
                        <td class="py-4 text-center">
                            {{ $detalles->producto->get_precio_venta() }}
                        </td>
                        <td class="py-4 text-center">
                            {{ $detalles->total }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="sm:w-full md:w-1/3 p-6 bg-white h-72 border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">
        <div>
            <h5 class="text-lg mb-4 font-medium text-gray-600 dark:text-white">Resumen del pedido:</h5>

            <table class="w-full text-sm text-gray-500 dark:text-gray-400 mb-5">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 text-left">
                            Subtotal
                        </td>
                        <td class="py-1 text-right">
                            {{ $subtotal }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 text-left">
                            Iva
                        </td>
                        <td class="py-1 text-right">
                            {{ $iva }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-1 text-left">
                            Total
                        </td>
                        <td class="py-1 text-right">
                            {{ $total }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="wallet_container" class="text-center"></div>

        {{-- SDK MercadoPago.js --}}
        <script src="https://sdk.mercadopago.com/js/v2"></script>

        <script>

            const mp = new MercadoPago('APP_USR-4809aa95-f0a3-452a-bce4-77349930b8fc', {
                locale: 'es-MX'
            });

            //Comprador
            //TESTUSER1332417413
            //YxEun87kJq

            //5120 6944 7061 6271

            const bricksBuilder = mp.bricks();

            mp.bricks().create("wallet", "wallet_container", {
                initialization: {
                    preferenceId: "{{ $preference->id }}",
                    redirectMode: 'modal'
                },execute a function when paymenexecute a function when payment is approved in mercado pagot is approved in mercado pago
            });

        </script>

    </div>

</div>
@endsection