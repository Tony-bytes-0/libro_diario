<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibroMovimiento extends Model
{
    protected $fillable = [
        'descripcion',
        'rif',
        'tipo_documento',
        'periodo'
    ];

        public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
