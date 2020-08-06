@extends('index')
@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 cuerpo">
        <h1> Crear Usuario administrador/vendedor</h1>
        <div class="card-body">
            <form id="crear_usuario">
                <div class="input-group form-group elemento">
                    <input type="text" name="txtNewCorreo" class="form-control" placeholder="Correo">
                </div>
                <div class="input-group form-group elemento">
                    <input type="password" name="txtNewPassword" class="form-control" placeholder="Contraseña">
                </div>
                <div class="input-group form-group elemento">
                    <select name="txtRol" class="form-control">
                       <option selected value="null">Seleccionar Rol</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                    </select>
                </div>
                <div class="form-group elemento">
                    <input type="submit" value="Crear" class="btn btn-primary login_btn">
                </div>
                <div class="form-group elemento"> 
                    <h5 id="sincuenta">¿Ya tienes cuenta?</h5>
                    <a href="/index" class="btn btn-primary btnCre">Ingresar</a>                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection