<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteZ extends Model
{
    protected $table = 'reportes_z';
    protected $guarded = [];

    public function asientoContable()
    {
        return $this->morphOne(AsientoContable::class, 'documento');
    }
}
