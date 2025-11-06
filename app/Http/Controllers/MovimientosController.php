<?php

namespace App\Http\Controllers;

use App\Models\LibroMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MovimientosController extends Controller
{
    public function insert(Request $request){
        $validated = $request->validate([
            'libro_movimiento' => 'required|array',
            'libro_movimiento.periodo' => 'required|date',
            'libro_movimiento.rif' => 'nullable|string', /////// esto estaba required, y si es un "resumen diario de ventas" no posee rif, cambie a nullable, en todo caso, habria que relacionarlo con el id del cliente aqui, y no en movimientos
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
            'movimientos.*.base_imponible_alic_contribuyente' => 'nullable|numeric',
            'movimientos.*.base_imponible_alic_no_contribuyente' => 'nullable|numeric',
            'movimientos.*.porcentaje_iva_aplicado' => 'nullable|numeric',
            'movimientos.*.porcentaje_retencion_aplicado' => 'nullable|numeric',
            'movimientos.*.impuesto_iva' => 'nullable|numeric',
            'movimientos.*.retencion_iva_soportada' => 'nullable|numeric',
            'movimientos.*.contribuyente' => 'nullable|boolean',
            //'movimientos.*.' => 'nullable',
        ]);
        $transactionResult = DB::transaction(function () use ($validated){
            $queryStatus = [//saber el estado de cada query al final
                'libro_movimiento' => null,
                'movimientos' => null,
                'movimientos_creados' => 0
            ];
            $LibroMovimiento = LibroMovimiento::create($validated['libro_movimiento']);
            $libro_movimiento_id = $LibroMovimiento->toArray()['id'];
            $queryStatus['libro_movimiento'] = 201;

            foreach($validated['movimientos'] as $movimiento){
                $movimiento['libro_movimiento_id'] = $libro_movimiento_id;
                Movimiento::create($movimiento);
            }
            $queryStatus['movimientos'] = 201;
            $queryStatus['movimientos_creados'] = count($validated['movimientos']);

            Log::info('Creacion de libro_movimiento: ',
            [
                'libro_movimiento: ' => $LibroMovimiento,
                'movimientos: ' => $validated['movimientos']
            ]);
            return $queryStatus;
        });

        //dd($insertedLibroMoimiento);

        return response()->json([
        'msg' => 'registro de movimientos exitoso',
        'estados' => $transactionResult
    ]);
    }
}
