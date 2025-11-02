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

Route::get('reporteLibroDiario', function () {
    return Inertia::render('ReporteLibroDiario');
})->middleware(['auth', 'verified'])->name('reporteLibroDiario');
//reportes
Route::get('reportes/libro/ventas', [ReportesController::class, 'libroVentas'] );

//Route::get('registrarLibroDiario', [LibroDiario::class, 'view'])->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
