<?php

namespace App\Http\Controllers;

use App\Models\MovimientoCuentasContable;
use Illuminate\Http\Request;

class MovimientoCuentasContables extends Controller
{
    public function insertar($movimientoId, $cuentas_contables){
        foreach($cuentas_contables as $entry){
            $entry['movimiento_id'] = $movimientoId;
            $entry['cuentas_contables_id'] = $entry['id'];
            MovimientoCuentasContable::create($entry);
        }

    }
}
