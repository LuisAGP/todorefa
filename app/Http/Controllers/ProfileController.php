<?php

namespace App\Http\Controllers;

use App\Models\UserAdress;
use Illuminate\Http\Request;
use App\Models\ZipCode;

class ProfileController extends Controller
{
    public function index(){
        return view('cuenta', [
            'user' => auth()->user()
        ]);
    }

    public function store(Request $request){

        // Validación
        $this->validate($request, [
            'name' => 'required|max:200',
            'lastname' => 'required|max:200'
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->save();

        return back();

    }

    public function obtenerUbicacion(Request $request){

        try {

            $ubicaciones = ZipCode::where('code', $request->code)->get();
            
            $repetidos = [];
            $states    = [];
            $cities    = [];
            $locations = [];


            foreach ($ubicaciones as $ubicacion => $value) {

                if(!in_array($value->state, $repetidos)){
                    $states[] = [
                        "id" => $value->state->id,
                        "name" => $value->state->name
                    ];
                    $repetidos[] = $value->state;
                }
                if(!in_array($value->city, $repetidos)){
                    $cities[] = [
                        "id" => $value->city->id,
                        "name" => $value->city->name
                    ];
                    $repetidos[] = $value->city;
                }

                $locations[] = [
                    "id" => $value->id,
                    "location" => $value->location
                ];

            }

            return response()->json([
                'states' => $states,
                'cities' => $cities,
                'locations' => $locations,
                'code' => 200
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 500,
            ]);
        }

    }
}
