<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id',
        'name'
    ];

    public function getMarca(){
        return Brand::find($this->brand_id)->name;
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getTotalProducts(){
        return Product::where('brand_model_id', $this->id)->get()->count();
    }

}
