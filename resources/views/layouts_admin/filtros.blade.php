@if(count($consulta)>0)

@foreach($consulta as $row)
<tr>
    <th scope="row">{{ $row["documento"]  }} </th>
    <td>{{ $row["nombre"]  }}</td>
    <td>{{ $row["correo"]  }}</td>
    <td>{{ $row["direccion"]  }}</td>
    <td>
        <button type="button" value='{{ $row["id"]  }}' class="btn btn-primary btnElimUsuario">Eliminar</button>
        <button type="button" value='{{ $row["id"]  }}' class="btn btn-primary btnActuUsuario">Actualizar</button>
    </td>
    <td>   
    </td>
</tr>
@endforeach
@else
<div class='alert alert-danger' role='alert'>
    No hay Usuarios
</div>
@endif

