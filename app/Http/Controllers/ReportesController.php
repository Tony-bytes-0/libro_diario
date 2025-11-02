<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportesController extends Controller
{
    public function libroVentas(Request $request){
        return Inertia::render('reportes/libro_ventas/LibroVentas');
    }
}
