<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\tblPersonas;
use Response;

class vendedorController extends Controller
{
    //Función que obtiene los clientes para mostrarlos al rol de vendedor
    public function Filtroclientes(request $request){
        try {
            //Debido a que el vendedor solo puede ver clientes
            //Se crea el filtro como una constante
            $filtro = 'Cliente';
            //Válida si hicieron un filtro con el buscador
            if(strlen($request["filtro"]) > 0){
                $consulta = tblPersonas::select('id','documento','nombre','correo','direccion')
                ->where('id','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('documento','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('nombre','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('correo','LIKE','%' . $request["filtro"] . '%')
                ->orWhere('tipo','='. $filtro)
                ->paginate(100);
            }else{
                //Sino hicieron filtro, obtiene todos los clientes
                $consulta = tblPersonas::select('id','documento','nombre','correo','direccion')
                ->where('tipo',$filtro)
                ->paginate(100);
            }
            //Retorna una vista que tiene una tabla y se pinta todos los clientes
            return Response::json(View::make('layouts_admin/filtros', compact('consulta'))->render()); 
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
