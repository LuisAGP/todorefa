<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Cart;
use App\Models\UserAdress;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function has_permission($permission){
        
        $userPermission = UserPermission::where('user_id', $this->id)
        ->where('permission_id', $permission)
        ->exists();

        if($userPermission){
            return true;
        }else{
            return false;
        }

    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function get_subtotal_carrito(){
        
        if(isset($this->cart)){
            $total = 0;
            
            foreach($this->cart as $detalle){
                $total += $detalle->stock*$detalle->product->precio_venta;
            }

            return "$".number_format($total, 2, ".", ",");

        }else{
            return "$".number_format(0, 2, ".", ",");
        }
    }

    public function get_total_carrito(){

        if(isset($this->cart)){
            $total = 0;
            
            foreach($this->cart as $detalle){
                $total += $detalle->stock*$detalle->product->precio_venta;
            }

            // Se agrega precio de envío
            return "$".number_format($total+97, 2, ".", ",");

        }else{
            return "$".number_format(0, 2, ".", ",");
        }

    }

    public function domicilios(){
        return $this->hasMany(UserAdress::class);
    }

}
