<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandModelController extends Controller
{
    
    public function index(){

        $modelos = BrandModel::all();
        $marcas = Brand::all();
        return view('admin.brandModels', [
            'modelos' => $modelos,
            'marcas' => $marcas
        ]);

    }

    public function indexShop(Request $request){

        $search = NULL;

        if(isset($request->search)){
            $search = $request->search;
            $productos = Product::where('brand_model_id', $request->id)
            ->where(function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('code', 'like', '%'.$search.'%');
            })->latest();
        }else{
            $productos = Product::where('brand_model_id', $request->id)->latest();
        }

        return view('brandModelParts', [
            'model' => BrandModel::find($request->id),
            'productos' => $productos->paginate(20),
            'search' => $search
        ]);
        
    }

    public function guardarModelo(Request $request){
        
        // Validación
        $this->validate($request, [
            'name' => 'required|max:250',
            'brand_id' => 'required'
        ]);

        if(isset($request->id)){

            // Editar marca existente
            $model           = BrandModel::find($request->id);
            $model->name     = $request->name;
            $model->brand_id = $request->brand_id;
            $model->save();

        }else{

            // Guardar nueva marca
            $model = BrandModel::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id
            ]);

        }

        if(isset($request->image)){
            
            $nombreImagen   = Str::uuid() . ".". $request->image->extension();
            $imagenPath     = public_path('uploads/models') . '/' . $nombreImagen;
            $imagenServidor = Image::make($request->image);

            $imagenServidor->save($imagenPath);
            
            $model->image = $nombreImagen;
            $model->save();

        }

        return back();

    }


    public function destroy(Request $request){

        if($request->user()->has_permission(1)){
            $modelo = BrandModel::find($request->id);
            
            $imagen_path = public_path('uploads/models/' . $modelo->image);

            if(File::exists($imagen_path)){
                unlink($imagen_path);
            }

            $modelo->delete();
        }

        return back();

    }

}
