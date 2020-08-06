@extends('layouts_admin/headeradmin')
@section('content')
<div>
    <input value="usuario" class="tipo" readonly type="hidden">
</div>
<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 contenido_menu">
    <div class="menu">
        <ol class="breadcrumb">
            <button type="button" class="btn btn-primary btnCrearUsuario">Crear Usuarios</button>
        </ol>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 panel_inicio">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 panel_busqueda">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control btnBuscar" placeholder="Buscar">
                            &nbsp
                            <button type="button" class="btn btn-primary btnFiltrar">Filtrar</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 panel_tabla">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Documento</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="replace">
                        </tbody>
                    </table>
                    <div id="pagin">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection