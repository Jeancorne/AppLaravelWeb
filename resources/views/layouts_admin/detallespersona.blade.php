<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalles De: {{ $consulta[0]["nombre"] }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="actualizarUsuario">
                <div class="modal-body">
                    <input type="text" class="form-control" name="txtdocumento" value='{{ $consulta[0]["documento"] }}'
                        placeholder="Documento">
                    <br>
                    <input type="text" class="form-control" name="txtnombre" value='{{ $consulta[0]["nombre"] }}'
                        placeholder="Nombre">
                    <br>
                    <input type="text" class="form-control" name="txtcorreo" value='{{ $consulta[0]["correo"] }}'
                        placeholder="Correo">
                    <br>
                    <input type="text" class="form-control" name="txtdireccion" value='{{ $consulta[0]["direccion"] }}'
                        placeholder="Dirección">
                    <br>                                     
                    @if($consulta[0]["tipo"] == "Usuario")
                    <select name="txtTipo" class="form-control">
                        <option selected option='{{ $consulta[0]["nombre"] }}'>{{ $consulta[0]["tipo"] }}</option>
                        <option option="cliente">cliente</option>
                    </select>
                    @else
                    <select name="txtTipo" class="form-control">
                        <option selected option='{{ $consulta[0]["nombre"] }}'>{{ $consulta[0]["tipo"] }}</option>
                        <option option="usuario">usuario</option>
                    </select>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnUpdate">Actualizar</button>
                    <button type="button" class="btn btn-primary btnocultar" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>