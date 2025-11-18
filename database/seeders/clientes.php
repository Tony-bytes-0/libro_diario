<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class clientes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    /*
    'AKERMED C.A.',
    'AK GYM C.A.',
    'NAVIERA RASSI C.A.',
    'LICOMARKET C.A.',
    'FABRICA DE TABACOS BERMUDEZ C.A.',
    'MS DILO C.A.',
    'RED POINT AUTOPARTS C.A.',
    'AUTOPARTES EL VENEZOLANO C.A.',
    'ADMINISTRADORA SOL Y MAR, SRL',
    'INSTALACIONES ELECTROHIDRAULICAS C.A.',
    'FUNDACION TEATRO LUIS MARIANO RIVERA',
    'AKERMED C.A.',
    'R&R DIAGNOSTICO C.A.',
    'ALCALDIA BOLIVARIANA DEL MUNICIPIO MEJIA',
    'TRANSPORTE "EL FAMOSO"',
    'CORPORACION SOCIALISTA DE DESARROLLO DEL ESTADO SUCRE',
    'SERVINAVE C.A.',
    'ATENCION FAMILIAR MEDICO INTEGRAL C.A.',
    'PROYMO C.A.',
    'LACTEOS EMBUTIDOS LA QUINTA ORIENTAL C.A.',
    'IMPRECOPIAS GRAFICAS C.A.',
    'FUNDACION PARA EL DESARROLLO DE LA CIENCIA Y TECNOLOGIA EN EL ESTADO SUCRE',
    'ATIMED C.A.',
    'METALURGICA MANZANARES C.A.',
    'MASCOTIENDA CLINICA VETERINARIA C.A.',
    'SB, SA INGENIERA',
    'U.E. INSTITUTO LIBERTADOR'*/
    {
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
