<?php

namespace App\Http\Controllers;

use App\Models\marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        return response()->json(['marcas' => marcas::all()]);
    }
}
