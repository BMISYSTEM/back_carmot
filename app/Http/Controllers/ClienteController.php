<?php
namespace App\Http\Controllers;
use App\Http\Requests\Clientes;
use App\Http\Resources\clientesResource;
use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function create(Clientes $request){
        
        $cedulas = '';
        $estratos = '';
        $declaracion = '';
        $solicitud = '';
        if($_FILES){
            if (isset($_FILES['cedulas'])) {
                $cedulas =$_FILES['cedulas']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/documentos/";
                $archivotmp = $_FILES['cedulas']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$cedulas));
                // $archivotmp->store();
            }
            if (isset($_FILES['estartos'])) {
                $estratos =$_FILES['cedulas']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/documentos/";
                $archivotmp = $_FILES['cedulas']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$estratos));
                // $archivotmp->store();
            }
            if (isset($_FILES['declaracion'])) {
                $declaracion =$_FILES['cedulas']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/documentos/";
                $archivotmp = $_FILES['cedulas']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$declaracion));
                // $archivotmp->store();
            }
            if (isset($_FILES['solicitudcredito'])) {
                $solicitud =$_FILES['cedulas']['name']['archivo'];
                // $ruta = $_SERVER['DOCUMENT_ROOT']."";
                $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/documentos/";
                $archivotmp = $_FILES['cedulas']['tmp_name']['archivo'];
                // $nombreURL = $archivotmp->store('imagenes');
                $datos = (move_uploaded_file($archivotmp,$ruta.$solicitud));
                // $archivotmp->store();
            }
        }
        $vehiculo = $request->validated();
        $user= Auth::user()->id;
        $creado = cliente::create([
            'nombre' => $vehiculo['nombre'],
            'apellido' => $vehiculo['apellido'],
            'cedula' => $vehiculo['cedula'],
            'date' => $vehiculo['data'],
            'telefono' => $vehiculo['telefono'],
            'email' => $vehiculo['email'],
            'vehiculos' => $vehiculo['vehiculos'],
            'vfinanciar' => $vehiculo['valorf'],
            'ncuotas' => $vehiculo['cuotas'],
            'tasa' => $vehiculo['tasa'],
            'doccedula'=>$cedulas,
            'docestratos'=>$estratos,
            'docdeclaracion'=>$declaracion,
            'docsolicitud'=>$solicitud,
            'valormensual'=>'0',
            'estados'=>'4',
            'users_id'=> $user
        ]);
        return $creado;
    }

    public function index()
    {
        return new clientesResource(cliente::with('user')->with('estado')->with('vehiculo')->get());
    }
}
