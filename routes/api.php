<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CuentaContableController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RolesPermisosController;
use App\Http\Controllers\Settings\ProfileController;

//consultar
Route::get('clientes', [ClientesController::class, 'consultar']);
Route::get('cuentas_contables', [CuentaContableController::class, 'consultar']);
Route::get('users', [ProfileController::class, 'consultarUsuarios']);

//creacion
Route::post('crear/movimientos', [MovimientosController::class, 'insert']);

//reportes
Route::post('reporte/libro/ventas', [ReportesController::class, 'libroVentas']);
Route::post('reporte/libro/compras', [ReportesController::class, 'libroCompras']);

//administrar
Route::post('administrar/clientes/crear', [ClientesController::class, 'crear']);
Route::post('administrar/cuenta_contable/crear', [CuentaContableController::class, 'crear']);
//Roles y permisos 
Route::post('rolespermisos/consultar', [RolesPermisosController::class, 'consultar']);
//borrar
Route::delete('borrar/usuarios/{id}', [ProfileController::class, 'borrarUsuario']);
