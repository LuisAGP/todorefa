<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index(){
        return view('auth.register');
    }
    
    public function store(Request $request){

        // Validación
        $this->validate($request, [
            'name' => 'required|max:200',
            'lastname' => 'required|max:200',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        // Creación del usuario
        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password'=> $request->password
        ]);

        // Autenticatiónrequired
        auth()->attempt($request->only('email', 'password'));

        // Redirección
        return redirect()->route('home');

    }

}
