<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LibroDiario;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//registros
Route::get('registroLibroDiario', function () {
    return Inertia::render('RegistroLibroDiario');
})->middleware(['auth', 'verified'])->name('registroLibroDiario');

//reportes
Route::get('reportes/libro_ventas/LibroVentas', function () {
    return Inertia::render('reportes/libro_ventas/LibroVentas');
})->middleware(['auth', 'verified'])->name('viewLibroVentas');

Route::get('reportes/libro_compras/LibroCompras', function () {
    return Inertia::render('reportes/libro_compras/LibroCompras');
})->middleware(['auth', 'verified'])->name('viewLibroCompras');

//administrar
Route::get('administrar/clientes/Clientes', function () {
    return Inertia::render('administrar/clientes/Clientes');
})->middleware(['auth', 'verified'])->name('viewCreateClients');

require __DIR__.'/settings.php';
