<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){

        $carrito = Cart::where('user_id', auth()->user()->id)->get();

        if(count($carrito) > 0){
            $importes = $carrito->first()->get_amount();
        };

        return view('carrito.userCart', [
            'detallesCarrito' => $carrito,
            'subtotal' => isset($importes['subtotal']) ? $importes['subtotal'] : 0,
            'iva' => isset($importes['iva']) ? $importes['iva'] : 0,
            'total' => isset($importes['total']) ? $importes['total']: 0,
        ]);
    }

    public function guardarProducto(Request $request){

        try {

            $carrito = Cart::where('product_id', $request->id)->where('user_id', auth()->user()->id)->first();
            $producto = Product::find($request->id);

            if(isset($carrito)){
                $carrito->stock += $request->stock;
                $carrito->save();
            }else{
                $carrito = Cart::create([
                    'product_id' => $request->id,
                    'user_id' => auth()->user()->id,
                    'stock' => $request->stock
                ]);
            }

            return response()->json([
                'url' => route('productosModelo', $producto->brand_model_id),
                'code' => 200
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code' => 500,
            ]);

        }

    }

    public function update(Cart $cart, Request $request){

        try {

            $cart->stock = $request->stock;
            $cart->save();

            $importes = $cart->get_amount();
            
            return response()->json([
                'id' => $cart->id,
                'stock' => $cart->stock,
                'totalProducto' => $cart->get_total(),
                'subtotal' => $importes['subtotal'],
                'iva' => $importes['iva'],
                'total' => $importes['total'],
                'code' => 200
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code' => 500,
            ]);

        }

    }

    public function destroy(Cart $cart){
        $cart->delete();
        return back(); 
    }
}
