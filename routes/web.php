<?php

use App\Http\Controllers\LibroDiario;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('registroLibroDiario', function () {
    return Inertia::render('RegistroLibroDiario');
})->middleware(['auth', 'verified'])->name('registroLibroDiario');

Route::get('reporteLibroVentas', function () {
    return Inertia::render('ReporteLibroVentas');
})->middleware(['auth', 'verified'])->name('reporteLibroVentas');
//reportes
Route::get('reportes/libro/ventas', [ReportesController::class, 'viewLibroVentas'] );

//Route::get('registrarLibroDiario', [LibroDiario::class, 'view'])->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
