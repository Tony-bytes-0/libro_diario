<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReportesController extends Controller
{
    public function viewLibroVentas(Request $request){
        return Inertia::render('reportes/libro_ventas/LibroVentas');
    }

    public function libroVentas(Request $request){
        $validated = $request->validate(
            [
                'mes' => 'nullable',
                'anio' => 'nullable'
            ]
        );

        $libro_movimientos = DB::table('libro_movimientos as libro')
            ->select('*')
            ->where('libro.tipo_documento', '=', 'libro de ventas')
            ->whereYear('libro.periodo' , '=', $validated['anio'])
            ->whereMonth('libro.periodo', '=', $validated['mes'])
            ->get();

        $libroIds = $libro_movimientos->pluck('id');

        $movimientos = DB::table('movimientos')
        ->whereIn('libro_movimiento_id', $libroIds)
        ->get()->groupBy('libro_movimiento_id');

        $result = $libro_movimientos->map(function ($libro) use ($movimientos) {
            $libro->movimientos = $movimientos->get($libro->id, []);
            return $libro;
        });
        /*
        $result = DB::table('libro_movimientos as libro')
        ->leftJoin('movimientos as movimiento', 'movimiento.libro_movimiento_id', '=', 'libro.id')
        ->select([
            'libro.id as libro_id',
            'libro.periodo as libro_periodo', 
            'libro.rif as libro_rif', 
            'libro.tipo_documento as libro_tipo_documento',
            'movimiento.fecha as movimiento_fecha',
            'movimiento.tipo_documento as movimiento_tipo_documento',
            'movimiento.maquina_fiscal as maquina_fiscal',
            'movimiento.primera_factura',
            'movimiento.ultima_factura',
            'movimiento.numero_factura',
            'movimiento.factura_afectada',
            'movimiento.total_ventas',
            'movimiento.base_imponible_alic_contribuyente',
            'movimiento.base_imponible_alic_no_contribuyente',
            'movimiento.porcentaje_iva_contribuyente',
            'movimiento.porcentaje_iva_no_contribuyente',
            'movimiento.impuesto_iva',
            'movimiento.retencion_iva_soportada',
            //'movimiento. as ',
        ])
        //->select('libro.rif as libro_rif', 'libro.documento as libro_tipo_documento', 'libro.periodo as libro_periodo')
        ->where('libro.tipo_documento', '=', 'libro de ventas')
        ->whereYear('libro.periodo', '=', $validated['anio'])
        ->whereMonth('libro.periodo', '=', $validated['mes'])
        ->get();
        */



        return response()->json([
            'msg' => 'consulta exitosa', 
            'result' => $result
        ], 200);
    }
}

