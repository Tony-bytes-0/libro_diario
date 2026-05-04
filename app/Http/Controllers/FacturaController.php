<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacturaController extends Controller
{
    public function create()
    {
        // Traemos los clientes de prueba (asegurándonos de tener algunos campos clave)
        $clientes = Cliente::select('id', 'descripcion', 'rif')->get();

        return Inertia::render('facturas/Registrar', [
            'clientes' => $clientes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'facturas' => 'required|array|min:1',
            'facturas.*.tipo' => 'required|in:venta,compra',
            'facturas.*.fecha' => 'required|date',
            'facturas.*.cliente_id' => 'required|exists:clientes,id',
            'facturas.*.numero_factura' => 'required|string',
            'facturas.*.numero_control' => 'nullable|string',
            'facturas.*.base_imponible' => 'required|numeric|min:0',
            'facturas.*.porcentaje_iva' => 'required|numeric|min:0',
            'facturas.*.impuesto_iva' => 'required|numeric|min:0',
            'facturas.*.total_ventas' => 'required|numeric|min:0',
        ]);

        foreach ($request->facturas as $facturaData) {
            Factura::create($facturaData);
        }

        return redirect()->back()->with('success', 'Facturas registradas exitosamente.');
    }
}
