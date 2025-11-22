<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesPermisosController extends Controller
{
    public function consultar(Request $request)
    {
        $roles = DB::table('roles')->get();
        $permisos = DB::table('permisos')->get();

        return response()->json([
            'msg' => 'roles y permisos consultados con exito',
            'roles' => $roles,
            'permisos' => $permisos
        ]);
    }

    public function asignarRol(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        DB::table('users')
            ->where('id', $validate['user_id'])
            ->update([
                'role_id' => $validate['role_id']
            ]);

        return response()->json([
            'msg' => 'rol asignado con exito'
        ]);
    }

    public function asignarPermiso(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required',
            'permiso_id' => 'required',
        ]);

        DB::table('users')
            ->where('id', $validate['user_id'])
            ->update([
                'permiso_id' => $validate['permiso_id']
            ]);

        return response()->json([
            'msg' => 'rol asignado con exito'
        ]);
    }
}
