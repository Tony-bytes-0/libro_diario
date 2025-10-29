<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroDiario extends Controller
{
    public function view(){
        return Inertia::render('registroLibroDiario/RegistroLibroDiario');
    }
}
