<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function getModels(){
        return BrandModel::where('brand_id', $this->id)->get();
    }

    public function models(){
        return $this->hasMany(BrandModel::class);
    }

}