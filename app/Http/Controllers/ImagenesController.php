<?php

namespace App\Http\Controllers;

use Dotenv\Store\File\Paths;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\String\ByteString;

class ImagenesController extends Controller
{
    public function store()
    {


        return response()->json('conectado a la api');
        //asi se descargan los documentos
        // $paht = Paths()->resolve(__DIR__.'/imagenes/DISTRI.png');
        // $imagenes = ByteString($paht);
        // return  response()->download($paht);
        // return response()->json($paht);
    }

    public function link()
    {
        Artisan::call('storage:link');
    }
}
