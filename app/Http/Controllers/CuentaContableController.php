<?php

namespace App\Http\Controllers;

use App\Models\CuentasContable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function importar(Request $request){
        $validate = $request->validate([
            'cuentas' => 'required|array',
            'cuentas.*.codigo' => 'required|string',
            'cuentas.*.descripcion' => 'required|string',
        ]);

        DB::transaction(function () use ($validate) {
            foreach($validate['cuentas'] as $cuenta){
                CuentasContable::create($cuenta);
            }
        });

        return response()->json(['msg' => 'Cuentas importadas con éxito']);
    }

    public function consultar(){
        $result = DB::table('cuentas_contables')->select(['id','codigo','tipo','descripcion'])->get();

        return response()->json(['msg' => 'cuentas consultadas con exito', 'cuentas_contables' => $result]);
    }


}
