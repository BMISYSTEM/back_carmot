<?php

namespace App\Http\Controllers;

use App\Http\Requests\Estados;
use App\Models\estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function create(Estados $request)
    {
        $estado = $request->validated();

        $creado = estado::create([
            'estado' => $estado['nombre']
        ]);

        return "se creo correctamente";
    }
    public function index()
    {
        return response()->json(['estados'=>estado::all()]);
    }
}
