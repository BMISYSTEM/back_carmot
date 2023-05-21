<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehiculos;
use App\Models\vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function create(Vehiculos $request)
    {
        $vehiculos = $request->validated();
        $foto1 ='';
        $foto2 ='';
        $foto3 ='';
        $foto4 ='';
        $peritaje ='';
        if($_FILES){
            if ($_FILES['foto1']) {
                $foto1 =$_FILES['foto1']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/vehiculos/";
                $archivotmp = $_FILES['foto1']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$foto1));
                $link = asset('/storage/'.$foto1);
                // $archivotmp->store();
            }
            if ($_FILES['foto2']) {
                $foto2 =$_FILES['foto2']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/vehiculos/";
                $archivotmp = $_FILES['foto2']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$foto2));
                $link = asset('/storage/'.$foto1);
                // $archivotmp->store();
            }
            if ($_FILES['foto3']) {
                $foto3 =$_FILES['foto3']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/vehiculos/";
                $archivotmp = $_FILES['foto3']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$foto3));
                $link = asset('/storage/'.$foto3);
                // $archivotmp->store();
            }
            if ($_FILES['foto4']) {
                $foto4 =$_FILES['foto4']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/vehiculos/";
                $archivotmp = $_FILES['foto4']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$foto4));
                $link = asset('/storage/'.$foto4);
                // $archivotmp->store();
            }
            if ($_FILES['peritaje']) {
                $peritaje =$_FILES['peritaje']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/peritaje/";
                $archivotmp = $_FILES['peritaje']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$peritaje));
                $link = asset('/storage/'.$peritaje);
                // $archivotmp->store();
            }
        }else{
        } 
        $create = vehiculo::create(
            [
            'placa' => $vehiculos['placa'],
            'kilometraje' => $vehiculos['kilometraje'],
            'foto1' => $foto1,
            'foto2' => $foto2,
            'foto3' => $foto3,
            'foto4' => $foto4,
            'marcas' => $vehiculos['marcas'],
            'modelos' => $vehiculos['modelos'],
            'estados' => $vehiculos['estados'],
            'valor' => $vehiculos['valor'],
            'peritaje' => $peritaje,
            ]
        );

        return ['mensaje'=>'Creado correctamente'];
        // return $_FILES['foto1'];

    }

    public function index()
    {
        return response()->json(vehiculo::all());
    }
}
