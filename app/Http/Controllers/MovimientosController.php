<?php

namespace App\Http\Controllers;

use App\Models\LibroMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientosController extends Controller
{
    public function insert(Request $request){
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
        $transactionResult = DB::transaction(function () use ($validated){
            $LibroMovimiento = LibroMovimiento::create($validated['libro_movimiento']);
            $libro_movimiento_id = $LibroMovimiento->toArray()['id'];

            foreach($validated['movimientos'] as $movimiento){
                $movimiento['libro_movimiento_id'] = $libro_movimiento_id;
                //echo(gettype($movimiento));
                Movimiento::create($movimiento);
            }
            return [
                'creacion de libro_movimiento' => 201,
                'creacion de movimientos' => 201
            ];
            //dd('datos de libro movimiento creado: ', $printScreen);
        });

        //dd($insertedLibroMoimiento);


        

        return response()->json([
        'msg' => 'registro de movimientos exitoso',
        'estados' => $transactionResult
    ]);
    }
}
