<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesPermisosController extends Controller
{
    public function consultar(Request $request){
        $roles = DB::table('roles')->get();
        $permisos = DB::table('permisos')->get();

        return response()->json([
            'msg' => 'roles y permisos consultados con exito',
            'roles' => $roles,
            'permisos' => $permisos
        ]);
    }
}
