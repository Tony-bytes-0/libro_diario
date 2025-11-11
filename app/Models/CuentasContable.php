<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentasContable extends Model
{

    protected $fillable = [
        'codigo',
        'descripcion',
        'tipo',
        
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
