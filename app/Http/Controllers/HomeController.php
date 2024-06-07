<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request){

        $search = NULL;

        if(isset($request->search)){
            $search = $request->search;
            $brands = BrandModel::where(function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhereIn('brand_id', function($q) use($search){
                    $q->from('brands')
                    ->select('id')
                    ->where('name', 'like', '%'.$search.'%');
                });
            })->latest();
        }else{
            $brands = BrandModel::latest();
        }


        return view('home', [
            'modelos' => $brands->paginate(8),
            'search' => $search
        ]);
    }

}
