<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <header id="header_index" class=".col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <img src="../imagenes/Konecta.png" />
            </header>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 panel_gestion">
                <h3>Gestionar</h3>
                <br>
                <div class="input-group form-group elemento">
                    <a href="/Administrador/usuarios" class="btn btn-primary btnCli">Usuarios</a>
                </div>
                <div class="input-group form-group elemento">
                    <a href="/Administrador/clientes" class="btn btn-primary btnCli">Clientes</a>
                </div>
                <div class="input-group form-group elemento">
                    <button class="btn btn-primary btnCli btnDeslogear">Cerrar Sesión</button>
                </div>
            </div>
            @yield('content')
            <div id="detalles">
            </div>
            <div id="modalCrear">
                <div class="modal" id="crearPersonaModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Crear Persona</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form id="crearPersona">
                                <div class="modal-body">
                                    <input type="text" class="form-control" name="txtdocumento" placeholder="Documento">
                                    <br>
                                    <input type="text" class="form-control" name="txtnombre" placeholder="Nombre">
                                    <br>
                                    <input type="text" class="form-control" name="txtcorreo" placeholder="Correo">
                                    <br>
                                    <input type="text" class="form-control" name="txtdireccion" placeholder="Dirección">
                                    <br>
                                    <select name="txtTipo" class="form-control">
                                        <option selected option='null'>Tipo</option>
                                        <option option="cliente">Cliente</option>
                                        <option option="usuario">Usuario</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btnCrearPersona">btnCrear</button>
                                    <button type="button" class="btn btn-primary btnocultar"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/admin.js"></script>
</body>

</html>