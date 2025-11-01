<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MovimientosController;

Route::get('clientes', [ClientesController::class, 'consultar']);

//creacion
Route::post('crear/movimientos', [MovimientosController::class, 'insert']);