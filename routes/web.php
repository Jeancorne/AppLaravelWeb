<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
    Sistema de rutas para la aplicación
*/

Route::get('/', function () {
    return view('welcome');
});
//Ruta para mostrar formulario del inicio de sesión
Route::get('/index', function () {
    return view('layouts/form_inicio');
});
//Ruta para mostrar el formulario de crear usuario administrador/vendedor
Route::get('crear', function () {
    return view('layouts/crearusuario');
});
//Ruta para crear usuario administrador o vendedor
Route::post('/crear_usuario','IndexController@crear_usuario')->name('crear_usuario');
//Ruta para logear
Route::post('/loggin','IndexController@login_usuario')->name('login_usuario');

//Ruta administrador
//Obtener todos los usuarios
Route::get('/Administrador/usuarios','adminController@ObtenerTodosUsuarios')->name('ObtenerTodosUsuarios');
//Obtener todos los clientes
Route::get('/Administrador/clientes','adminController@ObtenerTodosClientes')->name('ObtenerTodosClientes');

//Ver Detalles de persona
Route::post('/Administrador/obtenerusuario','adminController@obtenerusuario')->name('obtenerusuario');
//Actualizar persona
Route::post('/Administrador/ActualizarUsuario','adminController@actualizarUsuario')->name('actualizarUsuario');
//Eliminar Persona
Route::post('/Administrador/EliminarUsuario','adminController@EliminarUsuario')->name('EliminarUsuario');

//Crear persona
Route::post('/Administrador/CrearPersona','adminController@CrearPersona')->name('CrearPersona');

//Filtrar personas
Route::post('/Administrador/filtrar','adminController@FiltrarPersona')->name('FiltrarPersona');

//Cerrar sesión
Route::post('/Administrador/cerrar','adminController@cerrar')->name('cerrar');

//Index de vendedor
Route::get('/Vendedor/clientes', function () {
    return view('layouts_vendedor/vendedorclientes');
});

//Filtrar clientes para vendedores
Route::post('/vendedor/filtrar','vendedorController@Filtroclientes')->name('Filtroclientes');