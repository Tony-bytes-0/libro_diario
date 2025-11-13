<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCuentasContable extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'id',
        'tipo',
        'movimiento_id',
        'cuentas_contables_id',
    ];
}
