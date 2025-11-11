<?php

namespace App\Http\Controllers;

use App\Models\CuentasContable;
use Illuminate\Http\Request;

class CuentaContableController extends Controller
{
    public function crear(Request $request){
        $validate = $request->validate([
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        $result = CuentasContable::create($validate);

        return response()->json(['msg' => 'Cuenta creada con éxito']);
    }
}
