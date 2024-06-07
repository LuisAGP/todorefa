<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $marcas = Brand::all();
        return view('admin.brands', [
            'marcas' => $marcas
        ]);
    }

    public function guardarMarca(Request $request){
        
        // Validación
        $this->validate($request, [
            'name' => 'required|max:250'
        ]);

        if(isset($request->id)){

            // Editar marca existente
            $brand       = Brand::find($request->id);
            $brand->name = $request->name;
            $brand->save();

        }else{

            // Guardar nueva marca
            Brand::create([
                'name' => $request->name
            ]);

        }

        return back();

    }


    public function destroy(Request $request){

        if($request->user()->has_permission(1)){
            $marca = Brand::find($request->id);
            $marca->delete();
        }

        return back();
    }

}
