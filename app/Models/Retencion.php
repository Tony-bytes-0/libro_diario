<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retencion extends Model
{
    protected $table = 'retenciones';
    protected $guarded = [];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function asientoContable()
    {
        return $this->morphOne(AsientoContable::class, 'documento');
    }
}
