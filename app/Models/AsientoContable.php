<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsientoContable extends Model
{
    protected $table = 'asientos_contables';
    protected $guarded = [];

    public function documento()
    {
        return $this->morphTo();
    }

    public function detalles()
    {
        return $this->hasMany(DetalleAsiento::class);
    }
}
