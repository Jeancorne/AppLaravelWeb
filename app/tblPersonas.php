<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblPersonas extends Model
{
    //Modelo para tblPersonas
    //Obtiene los atributos con los que hace interacción
    protected $fillable  = ['nombre','documento','correo','direccion', 'tipo'];
    //Selecciona la tabla
    protected $table = 'tbl_personas';
    protected $primaryKey='id';   
}
