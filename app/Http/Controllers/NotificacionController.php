<?php

namespace App\Http\Controllers;

use App\Models\notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index()
    {
        $usuario = Auth()->user()->id;
        $mensajes = notificacion::where('user_id',$usuario)->get();
        return $mensajes;
    }
}
