<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\tblPersonas;
use Crypt;
use Validator;
use Response;
use Redirect;
use Session;
use Illuminate\Pagination\Paginator;
class adminController extends Controller
{
    //Función para retornar la vista de usuarios
    public function ObtenerTodosUsuarios(){ 
        try {
            return view('layouts_admin/adminusuarios');      
        } catch (\Throwable $th) {
            return $th;
        }      
        
    }
    //Función para retornar la vista de clientes
    public function ObtenerTodosClientes(){
    try {              
        return view('layouts_admin/adminclientes');   
    } catch (\Throwable $th) {
        return $th;
    }         
    }
    //Función que sirve para obtener los detalles del cliente/usuario    
    public function obtenerusuario(request $request){
        try {
            $id = $request["value"];   
             $consulta = tblPersonas::select('id','documento','nombre','correo','direccion','tipo')
            ->where('id','=',$id)->get()->toArray();       
            return Response::json(View::make('layouts_admin/detallespersona', compact('consulta'))->render());
        } catch (\Throwable $th) {
            return $th;
        }
    }
    //Función para actualizar el usuario
    public function actualizarUsuario(request $request){
        try {
            $data[] = "";
            $id  = $request["id"];
            $documento = $request["txtdocumento"];
            $nombre = $request["txtnombre"];
            $correo = $request["txtcorreo"];
            $direccion = $request["txtdireccion"];
            $tipo = $request["txtTipo"];
            $update =  tblPersonas::where('id',$id)
            ->update(['documento' => $documento,
                      'nombre' => $nombre,
                      'correo'=>$correo,
                      'direccion'=>$direccion,
                      'tipo'=>$tipo ]);
            if($update){
                $data['actualizado'] = "actualizado";
            }else{
                $data['error'] = "error"; 
            }
            return json_encode($data);            
        } catch (\Throwable $th) {
            return $th;
        }
    }
    //Función para eliminar usuario
    public function EliminarUsuario(request $request){
        try {
            $data[] = "";
            $id = $request["value"];
            $delete = tblPersonas::find($id);
            $delete->delete();
            if($delete){
                $data["ok"] = "";
            }
            return json_encode($data);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    //Cerrar sesión
    public function cerrar(){
          Session::flush();      
         return redirect('index');      
    }
    //Crear usuario/cliente
    public function CrearPersona(request $request){
        try {            
            $data[] = "";
            $documento = $request["txtdocumento"];
            $nombre = $request["txtnombre"];
            $correo = $request["txtcorreo"];
            $direccion = $request["txtdireccion"];
            $tipo = $request["txtTipo"];
            if($documento  != null &&
            $correo != null &&
            $nombre != null &&
            $direccion != null &&
            $tipo != "null")                
                {                   
                    $persona = [
                    'nombre' => $nombre,
                    'documento' => $documento,                    
                    'correo' => $correo,
                    'direccion' => $direccion,
                    'tipo' => $tipo
                    ];
                $id = tblPersonas::create($persona);
                if($id){
                    $data["ok"] = "";
                }

            }else{
                $data["Empty"] = "";
            } 
            return json_encode($data);

        } catch (\Throwable $th) {
            return $th;
        }
    }
    //Obtiene los datos de usuario/cliente
    //Recibe un filtro para la búsqueda y un tipo sea cliente/usuario
    public function FiltrarPersona(request $request){
        try {
            //Valida si hicieron un filtro
            if(strlen($request["filtro"]) > 0){
                $consulta = tblPersonas::select('id','documento','nombre','correo','direccion')
                ->where('id','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('documento','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('nombre','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('correo','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('tipo','='.$request["tipo0"])
                ->paginate(100);
            }else{
                //Sino hicieron filtro, obtiene las personas por el tipo sea usuario o cliente
                $consulta = tblPersonas::select('id','documento','nombre','correo','direccion')
                ->where('tipo',$request["tipo"])
                ->paginate(100);
            }            
            //Retorna una vista con una tabla y todos los datos que encontro
            return Response::json(View::make('layouts_admin/filtros', compact('consulta'))->render()); 
      
        } catch (\Throwable $th) {
            return $th;
        }
    }
}