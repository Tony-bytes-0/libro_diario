<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaDebito extends Model
{
    protected $table = 'notas_debito';
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
