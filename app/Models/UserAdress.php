<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\ZipCode;

class UserAdress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'state_id',
        'city_id',
        'zip_code_id',
        'adress',
        'phone_number'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function zip_code(){
        return $this->belongsTo(ZipCode::class);
    }

    public function resetSelected(){
        $domicilios = $this->user->domicilios;
        foreach ($domicilios as $key => $value) {
            $value->selected = 0;
        }
    }

    public function domicilio_formateado(){
        $direccion = $this->adress;
        $ciudad = $this->city->name;
        $estado = $this->state->name;
        $codigo = $this->zip_code->code;
        return $direccion.' '.$ciudad.', '.$estado.'. '.$codigo;
    }
}
