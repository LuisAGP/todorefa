<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'state_id',
        'city_id',
        'zip_code_id',
        'adress',
        'phone_number',
        'total',
        'total_products',
        'status'
    ];

}
