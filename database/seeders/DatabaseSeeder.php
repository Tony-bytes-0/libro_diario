<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

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

        Cliente::create([
            'rif' => 'J501371962',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'AKERMED C.A.',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J312164336',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'AK GYM C.A.',
            'telefono' => '',
            'correo' => '',
        ]);
            Cliente::create([
            'rif' => 'J299200581',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'LICOMARKET C.A.',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J300465535',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'ADMINISTAADORA SOL Y MAR, SRL',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create( [
            'rif' => 'J303762557',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'FABRICA DE TABACOS BERMUDEZ, CA',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create( [
            'rif' => 'V16669340',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'SILVIA DEL VALLE MARCANO ROJAS',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create( [
            'rif' => 'V32640669',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'ESTEFANI GONZALEZ',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J500684789',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'RED POINT AUTO PARTS, CA',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'N/A',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'RESUMEN DIARIO DE VENTAS',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'N/A',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'REPORTE GLOBAL DIARIO',
            'telefono' => '',
            'correo' => '',
        ]);
    }
}
