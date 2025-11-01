<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    public function new(Request $request){
        $validated = $request->validate([
            'libro_movimiento' => 'required|array',
            'libro_movimiento.periodo' => 'required|date',
            'libro_movimiento.rif' => 'required|string',
            'libro_movimiento.tipo_documento' => 'required|string',
            'libro_movimiento.descripcion' => 'nullable|string',
            //movimientos array
            'movimientos' => 'required|array',
            'movimientos.*.fecha' => 'nullable',
            'movimientos.*.cliente_id' => 'required|numeric',
            'movimientos.*.tipo_documento' => 'nullable|string',
            'movimientos.*.maquina_fiscal' => 'nullable|string',
            'movimientos.*.primera_factura' => 'nullable|string',
            'movimientos.*.ultima_factura' => 'nullable|string',
            'movimientos.*.numero_factura' => 'nullable|string',
            'movimientos.*.factura_afectada' => 'nullable|string',
            'movimientos.*.total_ventas' => 'nullable|numeric',
            'movimientos.*.total_ventas_no_gravadas' => 'nullable|numeric',
            //'movimientos.*.total_ventas_no_gravadas' => 'nullable|numeric',
            'movimientos.*.base_imponible_alic_contribuyente' => 'nullable|numeric',
            'movimientos.*.base_imponible_alic_no_contribuyente' => 'nullable|numeric',
            'movimientos.*.impuesto_iva' => 'nullable|numeric',
            'movimientos.*.retencion_iva_soportada' => 'nullable|numeric',
            //'movimientos.*.' => 'nullable',


        ]);
        return response()->json(['msg' => 'registro de movimientos exitoso']);
    }
}
