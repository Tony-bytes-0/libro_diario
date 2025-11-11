<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaContable extends Model
{

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
