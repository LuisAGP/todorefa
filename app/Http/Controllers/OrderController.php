<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(Request $request){

        $productos = [];
        $total     = 0;

        if(isset($request->id)){

            $request->stock = isset($request->stock) && $request->stock > 0 ? $request->stock : 1;
            $producto       = Product::find($request->id);

            if(!isset($producto)){
                return back();
            }

            $total       = $producto->precio_venta*$request->stock;
            $productos[] = (object) [
                'producto' => $producto,
                'stock'    => (int) $request->stock,
                'total'    => "$".number_format($total, 2, ".", ",")
            ];

        }else{
            $carrito = Cart::where('user_id', auth()->user()->id)->get();

            if(count($carrito) === 0){
                return back();
            }
            
            foreach ($carrito as $key => $value) {
                
                $productos[] = (object) [
                    'producto' => $value->product,
                    'stock'    => (int) $value->stock,
                    'total'    => "$".number_format($value->product->precio_venta*$value->stock, 2, ".", ",")
                ];

                $total += $value->product->precio_venta*$value->stock;
            }
        }

        return view('pedido.index', [
            'productos' => $productos,
            'subtotal'  => "$".number_format($total - ($total*0.16), 2, ".", ","),
            'iva'       => "$".number_format(($total*0.16), 2, ".", ","),
            'total'     => "$".number_format($total, 2, ".", ","),
            'request'   => $request
        ]);

    }



    public function generateOrder(Request $request){

        dd($request);

    }

    
}
