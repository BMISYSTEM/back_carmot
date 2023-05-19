<?php

namespace App\Http\Controllers;

use App\Http\Requests\Marca;
use App\Models\marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        return response()->json(['marcas' => marcas::all()]);
    }

    public function create(Marca $request){
        $nombre = $request->validated();
        $marcas = marcas::create([
            'nombre'=>$nombre['nombre']
        ]);
        return ['mensaje'=>'creado correctamente'];
    }
}
