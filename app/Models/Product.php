<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id',
        'brand_model_id',
        'code',
        'name',
        'description',
        'precio_compra',
        'precio_venta',
        'stock'
    ];

    public function imagenPortada(){
        $imagen = ProductImage::where('product_id', $this->id)->first();
        if($imagen){
            return "uploads/{$imagen->imagen}";
        }else{
            return '';
        }
    }

    public function html_description(){
        return str_replace("\n", "<br>", $this->description);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function model(){
        return $this->belongsTo(BrandModel::class, 'brand_model_id');
    }

    public function get_precio_venta(){
        return "$".number_format($this->precio_venta, 2, ".", ",");
    }

}
