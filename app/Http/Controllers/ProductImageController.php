<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    
    public static function guardarImagenProducto($imagenes, $idProducto){

        if(isset($imagenes)){

            foreach($imagenes as $imagen){
            
                $nombreImagen   = Str::uuid() . ".". $imagen->extension();
                $imagenPath     = public_path('uploads') . '/' . $nombreImagen;
                $imagenServidor = Image::make($imagen);
    
                $imagenServidor->save($imagenPath);
    
                ProductImage::create([
                    'product_id' => $idProducto,
                    'imagen' => $nombreImagen
                ]);
    
            }

        }

    }


    public function destroy(Request $request){

        try {
            $imagen = ProductImage::find($request->id);
            $imagen_path = public_path('uploads/' . $imagen->imagen);

            if(File::exists($imagen_path)){
                unlink($imagen_path);
            }

            $imagen->delete();

            return response()->json([
                'id' => $request->id,
                'message' => '¡Se eliminó con existo!',
                'code' => 200,
            ]);

        } catch (\Exception $e) {
            
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 500,
            ]);

        }

    }

}
