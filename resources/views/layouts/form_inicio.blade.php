@extends('index')
@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 cuerpo">
        <h1> Inicio de sesión </h1>
        <div class="card-body">
            <form id="inicio_sesion">
                <div class="input-group form-group elemento">
                    <input type="text" name="txtCorreo" class="form-control" placeholder="Correo">
                </div>
                <div class="input-group form-group elemento">
                    <input type="password" name="txtPassword" class="form-control" placeholder="Contraseña">
                </div>
                <div class="form-group elemento">                                        
                    <input type="submit" value="Entrar" class="btn btn-primary login_btn">
                </div>
                <div class="form-group elemento"> 
                    <h5 id="sincuenta">¿No tienes cuenta?</h5>
                    <a href="/crear" class="btn btn-primary btnCre">Crear</a>                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection