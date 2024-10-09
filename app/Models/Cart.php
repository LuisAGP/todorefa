<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\User;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'stock'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function get_total(){
        return "$".number_format($this->stock*$this->product->precio_venta, 2, ".", ",");
    }

    public function get_amount(){

        $carrito = $this->user->cart;
        $total   = 0;

        foreach ($carrito as $key => $value) {
            $total += $value->product->precio_venta*$value->stock;
        }
        
        return [
            'subtotal' => "$".number_format($total - ($total*0.16), 2, ".", ","),
            'iva' => "$".number_format(($total*0.16), 2, ".", ","),
            'total' => "$".number_format($total, 2, ".", ",")
        ];

    }

}
