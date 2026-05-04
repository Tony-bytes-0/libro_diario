<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleAsiento extends Model
{
    protected $table = 'detalle_asientos';
    protected $guarded = [];

    public function asientoContable()
    {
        return $this->belongsTo(AsientoContable::class);
    }

    public function cuentaContable()
    {
        return $this->belongsTo(CuentaContable::class);
    }
}
