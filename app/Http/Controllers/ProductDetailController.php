<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;


class ProductDetailController extends Controller
{

    public function index($id){
        return view('produtDetail', [
            'producto' => Product::find($id),
            'images' => ProductImage::where('product_id', $id)->get()
        ]);
    }

}
