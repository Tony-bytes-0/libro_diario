<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesYPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->updateOrInsert(
            ['nombre' => 'administrador'],
            [
                'descripcion' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('roles')->updateOrInsert(
            ['nombre' => 'gerencia'],
            [
                'descripcion' => 'Usuario con permisos para administrar, registrar, editar y eliminar',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('roles')->updateOrInsert(
            ['nombre' => 'analista'],
            [
                'descripcion' => 'Usuario analista, permisos basicos',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $adminId = DB::table('roles')->where('nombre', 'administrador')->first()->id;
        $gerenciaId = DB::table('roles')->where('nombre', 'gerencia')->first()->id;
        $analistaId = DB::table('roles')->where('nombre', 'analista')->first()->id;

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'administrador', 'role_id' => $adminId],
            [
                'descripcion' => 'administrador, permisos de superusuario completos',
            ]
        );

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'ver modulo, registrar libro diario', 'role_id' => $gerenciaId],
            [
                'descripcion' => 'ver modulo, registrar libro diario',
            ]
        );

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'ver modulo, reporte libro ventas', 'role_id' => $gerenciaId],
            [
                'descripcion' => 'ver modulo, reporte libro ventas',
            ]
        );

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'ver modulo, reporte libro compras', 'role_id' => $gerenciaId],
            [
                'descripcion' => 'ver modulo, reporte libro compras',
            ]
        );

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'ver modulo, administrar clientes', 'role_id' => $gerenciaId],
            [
                'descripcion' => 'ver modulo, administrar clientes',
            ]
        );

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'ver modulo, administrar cuentas contables', 'role_id' => $gerenciaId],
            [
                'descripcion' => 'ver modulo, administrar cuentas contables',
            ]
        );

        DB::table('permisos')->updateOrInsert(
            ['nombre' => 'ver modulo, administrar usuarios', 'role_id' => $gerenciaId],
            [
                'descripcion' => 'ver modulo, administrar usuarios',
            ]
        );

    }
}
