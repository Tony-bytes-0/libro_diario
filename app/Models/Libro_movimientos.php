<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro_movimientos extends Model
{
    protected $fillable = [
        'descripcion',
        'rif',
        'tipo_documento',
        'periodo'
    ];
}
