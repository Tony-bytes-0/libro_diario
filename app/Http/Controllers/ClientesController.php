<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClientesController extends Controller
{
    public function view()
    {
        return Inertia::render('administrar/clientes/Clientes');
    }
    public function consultar(Request $request)
    {
        $clients = DB::table('clientes')->select('*')->get();

        return response()->json([
            'msg' => 'clientes consultados con exito',
            'clientes' => $clients
        ]);
    }

    public function crear(Request $request)
    {
        $validated = $request->validate([
            'rif' => 'required|string',
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'nombre' => 'nullable|string',
            'apellido' => 'nullable|string',
            'telefono' => 'nullable|string',
            'correo' => 'nullable|string',
        ]);

        $result = Cliente::create($validated);

        return response()->json(['msg' => 'Creado con éxito'], 201);
    }
}

/*
<?php

use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::get('clientes', [ClientesController::class, 'consultar']);
*/
