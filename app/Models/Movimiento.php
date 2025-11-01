<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LibroMovimiento;

class Movimiento extends Model
{
    protected $fillable = [
        'cliente_id',
        'libro_movimientos_id',
        'fecha',
        'tipo_documento',
        'maquina_fiscal',
        'primera_factura',
        'ultima_factura',
        'numero_factura',
        'factura_afectada',
        'total_ventas',
        'total_ventas_no_gravadas',
        'base_imponible_alic_contribuyente',
        'base_imponible_alic_no_contribuyente',
        'porcentaje_iva_contribuyente',
        'porcentaje_iva_no_contribuyente',
        'impuesto_iva',
        'retencion_iva_soportada'
    ];

    public function libroMovimiento()
    {
        return $this->belongsTo(libroMovimiento::class);
        //return $this->belongsTo(libroMovimiento::class, 'libro_movimiento_id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }


}
