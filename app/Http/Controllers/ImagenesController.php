<?php

namespace App\Http\Controllers;

use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Symfony\Component\String\ByteString;

class ImagenesController extends Controller
{
    public function store()
    {
        //asi se descargan los documentos
        // $paht = Paths()->resolve(__DIR__.'/imagenes/DISTRI.png');
        // $imagenes = ByteString($paht);
        // return  response()->download($paht);

        // return response()->json($paht);
    }
}
