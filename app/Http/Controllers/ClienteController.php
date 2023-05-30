<?php
namespace App\Http\Controllers;
use App\Models\cliente;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use App\Http\Requests\Clientes;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Http\Resources\clientesResource;
use App\Models\notificacion;

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

    public function descargasdoc(Request $request)
    {
        $documento = $request['documento'];
        $paht = storage_path('app/public/documentos/'.$documento);
        return  response()->download($paht);
        // return $paht;
        // return $request;
    }


    //actualizacionn de estado 

    public function updateEstados (Request $request)
    {
        $estado = $request['id'];
        $cliente = $request['cliente'];
        $update = cliente::where('id',$cliente)->get();
        $update->toQuery()->update([
            'estados' => $estado
        ]);

        $mensaje = 'El cliente '. $request['user_name']. ' cambio de estado a '.$request['nombre_estado'];
        $notificacion = notificacion::create([
            'user_id' => $request['user'],
            'mensaje' => $mensaje,
            'visto' =>'no'
        ]);
        return 'el cambio se realizo de forma correcta';
    }

    public function vendidos()
    {

        $vista = DB::select("select c.id, c.nombre, c.apellido, c.cedula,c.date, c.telefono, c.email, c.vfinanciar, c.ncuotas, c.valormensual, c.doccedula, c.docestratos, c.docdeclaracion, c.docsolicitud, c.created_at, c.updated_at, c.vehiculos, c.estados, c.users_id, c.tasa,
        u.name,u.rol,v.valor,v.placa
        from clientes as c
        inner join users u on c.users_id = u.id
        inner join vehiculos v on c.vehiculos = v.id
        where c.estados ='7'");
        return response()->json($vista);
    }
    public function pendientes()
    {

        $vista = DB::select("select c.id, c.nombre, c.apellido, c.cedula,c.date, c.telefono, c.email, c.vfinanciar, c.ncuotas, c.valormensual, c.doccedula, c.docestratos, c.docdeclaracion, c.docsolicitud, c.created_at, c.updated_at, c.vehiculos, c.estados, c.users_id, c.tasa,
        u.name,u.rol,v.valor,v.placa,e.estado as nombre_estado
        from clientes as c
        inner join users u on c.users_id = u.id
        inner join vehiculos v on c.vehiculos = v.id
        inner join estados e on c.estados = e.id
        where c.estados ='4'");
        return response()->json($vista);
    }
    public function aprobados()
    {

        $vista = DB::select("select c.id, c.nombre, c.apellido, c.cedula,c.date, c.telefono, c.email, c.vfinanciar, c.ncuotas, c.valormensual, c.doccedula, c.docestratos, c.docdeclaracion, c.docsolicitud, c.created_at, c.updated_at, c.vehiculos, c.estados, c.users_id, c.tasa,
        u.name,u.rol,v.valor,v.placa,e.estado as nombre_estado
        from clientes as c
        inner join users u on c.users_id = u.id
        inner join vehiculos v on c.vehiculos = v.id
        inner join estados e on c.estados = e.id
        where c.estados ='5'");
        return response()->json($vista);
    }
 }

