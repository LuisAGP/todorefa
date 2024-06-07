<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index(){
        $productos = Product::all();
        return view('admin.productos', [
            'productos' => $productos
        ]);
    }

    public function nuevoProducto(){
        return view('admin.guardarProducto',[
            'marcas' => Brand::all()
        ]);
    }


    public function editarProducto($id){
        return view('admin.guardarProducto', [
            'product' => Product::find($id),
            'marcas' => Brand::all()
        ]);
    }

    public function guardarProducto(Request $request){

        // Validación
        $this->validate($request, [
            'code' => 'required|max:200',
            'brand_id' => 'required|exists:brands,id', 
            'brand_model_id' => 'required|exists:brand_models,id',
            'name' => 'required|max:200',
            'description' => 'required',
            'precio_compra' => 'required|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
            'precio_venta' => 'required|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
            'stock' => 'required:min:0'
        ]);

        if(isset($request->product_id)){

            // Guardar Producto Existente
            $producto                 = Product::find($request->product_id);
            $producto->brand_id       = $request->brand_id;
            $producto->brand_model_id = $request->brand_model_id;
            $producto->code           = $request->code;
            $producto->name           = $request->name;
            $producto->description    = $request->description;
            $producto->precio_compra  = $request->precio_compra;
            $producto->precio_venta   = $request->precio_venta;
            $producto->stock          = $request->stock;
            $producto->save();

        }else{

            // Guardar Nuevo Producto
            $producto = Product::create([
                'code' => $request->code,
                'brand_id' => $request->brand_id,
                'brand_model_id' => $request->brand_model_id,
                'name' => $request->name,
                'description' => $request->description,
                'precio_compra' => $request->precio_compra,
                'precio_venta' => $request->precio_venta,
                'stock' => $request->stock
            ]);

        }

        ProductImageController::guardarImagenProducto($request->imagen_producto, $producto->id);

        return redirect()->route('admin.productos');

    }

    public function destroy(Request $request){

        if($request->user()->has_permission(1)){
            $producto = Product::find($request->product_id);
            $imagenes = ProductImage::where('product_id', $request->product_id)->get();

            foreach ($imagenes as $imagen){
                $imagen_path = public_path('uploads/' . $imagen->imagen);

                if(File::exists($imagen_path)){
                    unlink($imagen_path);
                }

            }

            $producto->delete();
            
        }

        return back();

    }


    public function obtenerModelos(Request $request){
        return response()->json([
            'id' => $request->brand_id,
            'modelos' => BrandModel::where('brand_id', $request->brand_id)->get(),
            'code' => 200,
        ]);
    }


}
