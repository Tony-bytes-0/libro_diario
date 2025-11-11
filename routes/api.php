<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CuentaContableController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\ReportesController;

Route::get('clientes', [ClientesController::class, 'consultar']);

//creacion
Route::post('crear/movimientos', [MovimientosController::class, 'insert']);

//reportes
Route::post('reporte/libro/ventas', [ReportesController::class, 'libroVentas']);
Route::post('reporte/libro/compras', [ReportesController::class, 'libroCompras']);

//administrar
Route::post('administrar/clientes/crear', [ClientesController::class, 'crear']);
Route::post('administrar/cuenta_contable/crear', [CuentaContableController::class, 'crear']);