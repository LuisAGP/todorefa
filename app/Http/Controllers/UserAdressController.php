<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAdress;

class UserAdressController extends Controller
{
    public function guardarDomicilioUsuario(Request $request){

        try {
            
            // Edición
            if(isset($request->id)){
                $userAdress = UserAdress::find($request->id);
            }
            // Nuevo registro
            else{
                $userAdress = new UserAdress();
            }

            $this->validate($request, [
                'state_id' => 'required',
                'city_id' => 'required',
                'zip_code_id' => 'required',
                'adress' => 'required',
                'phone_number' => 'required',
                'selected' => 'required'
            ]);

            if($request->selected == 1){
                $userAdress->resetSelected();
            }

            $userAdress->user_id      = auth()->user()->id;
            $userAdress->state_id     = $request->state_id;
            $userAdress->city_id      = $request->city_id;
            $userAdress->zip_code_id  = $request->zip_code_id;
            $userAdress->adress       = $request->adress;
            $userAdress->phone_number = $request->phone_number;
            $userAdress->selected     = $request->selected;

            $userAdress->save();

            $domicilios = [];

            foreach (auth()->user()->domicilios as $key => $value) {
                $domicilios[] = [
                    'id' => $value->id,
                    'adress' => $value->adress,
                    'state_id' => $value->state_id,
                    'city_id' => $value->city_id,
                    'zip_code_id' => $value->zip_code_id,
                    'phone_number' => $value->phone_number,
                    'code' => $value->zip_code->code,
                    'selected' => $value->selected,
                    'domicilio' => $value->domicilio_formateado()
                ];
            }

            return response()->json([
                'message' => "¡Se guardo domicilio con éxito!",
                'domicilios' => $domicilios,
                'code' => 200,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 500,
            ]);
        }

    }

    public function eliminarDomicilioUsuario(Request $request){

        $userAdress = UserAdress::find($request->id);
        $userAdress->delete();

        return back();

    }
}
