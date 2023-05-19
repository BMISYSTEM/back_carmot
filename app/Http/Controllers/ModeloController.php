<?php

namespace App\Http\Controllers;

use App\Http\Requests\Modelos;
use App\Models\modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function create(Modelos $request)
    {
        $year = $request->validated();
        $create=modelo::create([
            'year'=>$year['year']
        ]);
        return $create;
    }
    public function index(){
        return response()->json(['modelos' => modelo::all()]);
    }
}
