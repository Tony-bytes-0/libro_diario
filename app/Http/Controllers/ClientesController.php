<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function consultar(Request $request){
        $clients = DB::table('clientes')->select('*')->get();

        return response()->json([
            'msg' => 'clientes consultados con exito',
            'clientes' => $clients
        ]);
    }
}

/*
<?php

use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::get('clientes', [ClientesController::class, 'consultar']);
*/
