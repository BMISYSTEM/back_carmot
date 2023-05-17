<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\login;
use App\Http\Requests\users;
use App\Models\Permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

use function PHPUnit\Framework\isNull;

class Authcontroller extends Controller
{
    public function login (login $request)
    {
             $data = $request->validated();
             //revisar password
             if (!Auth::attempt($data)) {
                return response([
                    'errors' => ['el imail o el password son incorrectos']
                ],422);
             }
             //autenticacion con token
             $user = Auth::user();
             $paht = public_path().'/imagenes/DISTRI.png';
             //ewnvio los permisos que tiene disponible
             $permisos = Permisos::where('user_id',$user->id)->get();
             return [
                'token' => $user->createToken('token')->plainTextToken,
                'user' => $user,
                'permisos' => $permisos,
                'imagen' =>$paht

             ];
            
    }
    public function logout(Request $request)
    {
      $user = $request->user();
      $user->currentAccessToken()->delete();
      return [
         'user' => null
      ];
    return $user;
   }

    public function create(users $request)
    {
        // 
        //imagen
        $nombre = '';
        $datos = '';
        if($_FILES){
            $nombre =$_FILES['imagen']['name']['archivo'];
            // $ruta = $_SERVER['DOCUMENT_ROOT']."";
            $ruta = $_SERVER['DOCUMENT_ROOT']."/storage/";
            $archivotmp = $_FILES['imagen']['tmp_name']['archivo'];
            // $nombreURL = $archivotmp->store('imagenes');
            $datos = (move_uploaded_file($archivotmp,$ruta.$nombre));
            $link = asset('/storage/'.$nombre);
            // $archivotmp->store();

        }else{
        } 
        
        $empresa = Auth::user()->empresa;



        $data = $request->validated();
        $insert = [
            
        ];
        $user= User::create([
            'name' =>$data['nombre'],
            'apellido' =>$data['apellido'],
            'email' =>$data['email'],
            'password' =>bcrypt($data['password']),
            'cedula' =>$data['cedula'],
            'empresa' =>$empresa,
            'img' =>$nombre,
            'rol'=>'0'
        ]);
        $permisos = Permisos::create([
            'dashboard'=>($data['dashboard']), 
            'administrador'=>($data['administrador']),
            'usuarios'=>($data['usuarios']),
            'recepcion'=>($data['recepcion']),
            'ajustes'=>($data['ajustes']),
            'campanas'=>($data['campanas']),
            'contabilidad'=>($data['contabilidad']),
            'transferencias'=>($data['transferencias']),
            'proveedor'=>($data['proveedor']),
            'user_id'=>$user->id
        ]);
        // return response()->json($_FILES) ;
        // return $data;
        return ['mensaje'=>"se creo el usuario"];





        
    }
  
    public function permisos(Request $request)
    {
        $user = $request->user();
        $permisos = Permisos::where('user_id',$user->id)->get();
        return $permisos;
    }
    public function force(){
        $user = User::create([
            'name'=> 'administrador',
            'email'=> 'admin1@admin1.com',
            'password'=>bcrypt('12345'),
            'empresa'=>'carmot',
            'cedula'=>'123456'
         ]);
         //creando el token para utenticar
         $user->createToken('token')->plainTextToken;
         return response()->json(['usuarios'=>User::all()]);
    }
}
