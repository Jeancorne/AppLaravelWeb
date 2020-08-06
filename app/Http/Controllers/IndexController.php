<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Crypt;
use Validator;
use Response;
use Redirect;
use Session;

class IndexController extends Controller
{
    public function crear_usuario(request $request){
        try {
            $data[] = "";
            $tabla_user = [];
            if($request["txtNewCorreo"] != null && $request["txtNewPassword"] != null && $request["txtRol"] != "null"){
                $tabla_user['name'] = $request["txtRol"]; 
                $tabla_user['email'] = $request["txtNewCorreo"]; 
                $tabla_user['password'] = bcrypt($request["txtNewPassword"]);
                DB::beginTransaction();                
                $id = User::create($tabla_user)->id;               
                DB::commit();
                $data['ok'] = "";
            }else{
              $data['campo_empty'] = "";
            }
            return json_encode($data);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function login_usuario(request $request){       
        try {
            $data[] = "";
            if($request["txtCorreo"] != null || $request["txtPassword"] != null){
                $credentials = [
                    'email' => $request['txtCorreo'],
                    'password' => $request['txtPassword'],
                ];
                $log = Auth::attempt($credentials);
                if($log){
                    $consulta = User::select('name')
                    ->where('email',$request['txtCorreo'])
                    ->get()->toArray();
                    $urlredirect = "";
                    if($consulta[0]["name"] == "Administrador"){
                        $urlredirect = "Administrador/clientes";
                    }
                    if($consulta[0]["name"] == "Vendedor"){
                        $urlredirect = "Vendedor/clientes";
                    }
                    $data["ok"] = $urlredirect;
                }else{
                    $data["noexiste"] = "";
                } 
            }else{
                $data['campo_empty'] = "";
            }
            return json_encode($data);
        } catch (Exception $e) {
            return $e;
        }          
    }
}