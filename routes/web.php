<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LibroDiario;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

//Registro, login, default o por defecto al no encontrar una ruta (manejar el error)
Route::get('/', function () {
    return Inertia::render('Dashboard', ['canRegister' => Features::enabled(Features::registration()),]);
});

Route::get('/login', function () {
    return Inertia::render('auth/Login');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified']);

//registros
Route::get('libro-diario/registrar', function () {
    return Inertia::render('registroLibroDiario/RegistroLibroDiario');
})->middleware(['auth', 'verified']);

//reportes  
Route::get('reportes/libro-ventas', function () {
    return Inertia::render('reportes/libro-ventas/LibroVentas');
})->middleware(['auth', 'verified']);

Route::get('reportes/libro-compras', function () {
    return Inertia::render('reportes/libro-compras/LibroCompras');
})->middleware(['auth', 'verified']);

//administrar
Route::get('administrar/clientes', function () {
    return Inertia::render('administrar/clientes/Clientes');
})->middleware(['auth', 'verified']);

///administrar/cuentas_contables
Route::get('administrar/cuentas-contables', function () {
    return Inertia::render('administrar/cuentas-contables/CuentasContables');
})->middleware(['auth', 'verified']);

//Administrar Usuarios
Route::get('administrar/usuarios', function () {
    return Inertia::render('administrar/usuarios/Usuarios');
})->middleware(['auth', 'verified']);


require __DIR__ . '/settings.php';
