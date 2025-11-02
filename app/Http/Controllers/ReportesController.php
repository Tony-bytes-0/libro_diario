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
                'mes' => 'nullable|required',
                'anio' => 'nullable|required'
            ]
        );

        $libro_movimientos = DB::table('libro_movimientos as libro')
            ->select('*')
            ->where('libro.tipo_documento', '=', 'libro de ventas')
            ->whereYear('libro.periodo' , '=', $validated['anio'])
            ->whereMonth('libro.periodo', '=', $validated['mes'])
            ->get();

        if ($libro_movimientos->count() === 0) {
            return response()->json([
                'message' => 'No se encontraron libros de ventas para el período seleccionado',
                'result' => []
            ], 204);
        }

        $libroIds = $libro_movimientos->pluck('id');
        
        $movimientos = DB::table('movimientos as movimiento')
        ->leftJoin('clientes as cliente', 'cliente.id', '=', 'movimiento.cliente_id')
        ->select([
            'movimiento.id as entry_id',
            'cliente.descripcion as cliente_descripcion',
            'cliente.rif as cliente_rif',
            'movimiento.libro_movimiento_id as libro_id',
            'movimiento.fecha', 
            'movimiento.tipo_documento',
            'movimiento.maquina_fiscal',
            'movimiento.primera_factura',
            'movimiento.ultima_factura',
            'movimiento.numero_factura',
            'movimiento.total_ventas',
            'movimiento.total_ventas_no_gravadas',
            'movimiento.base_imponible_alic_contribuyente',
            'movimiento.porcentaje_iva_no_contribuyente',
            'movimiento.impuesto_iva',
            'movimiento.porcentaje_iva_contribuyente',
            'movimiento.retencion_iva_soportada',
            ])
        ->whereIn('movimiento.libro_movimiento_id', $libroIds)
        ->get();


        return response()->json([
            'message' => 'consulta exitosa', 
            'movimientos' => $movimientos,
            'libro_movimientos' => $libro_movimientos,
            'new' => ''
        ], 200);
    }
}

