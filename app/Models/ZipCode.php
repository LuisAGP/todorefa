<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\State;
use App\Models\City;

class ZipCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'state_id',
        'city_id',
        'code',
        'location',
        'location_type'
    ];

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

}
