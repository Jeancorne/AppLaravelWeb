$(document).ready(function () {
    //llamar la función para obtener la tabla con los datos
    get_datos();
    //Cerrar sesión
    $('.btnCerrarSesion').on('click', function () {
        cerrar_sesion();
    })
})
//Function para cerrar sesión
function cerrar_sesion() {
    $.ajax({
        url: '/Administrador/cerrar',
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr, type) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (data) {
            Swal.fire(
                'Cerrando!',
                'Sesión!',
                'success'
            )
            setTimeout(function () {
                var redirect = "/index"
                $(location).attr('href', redirect);
            }, 2000);
        }
    })
}
//Función para obtener la tabla con datos
function get_datos(filtro) {
    $.ajax({
        url: '/vendedor/filtrar',
        type: 'POST',
        dataType: 'json',
        data: { filtro: filtro },
        beforeSend: function (xhr, type) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (data) {
            //Obtiene la tabla y la pone en el frontend 
            $('.replace').html(data);
            //Botón para filtrar datos
            $('.btnFiltrar').click(function () {
                //Obtiene el valor que escribieron
                var value = $('.btnBuscar').val();
                //Llama la función para que filtre y envía el valor escrito
                get_datos(value);
            })
            //Botón que muestra el Popup para registrar clientes
            $('.btnCrearUsuario').click(function () {
                //Muestra la ventana emergente para crear Clientes
                $('#crearPersonaModal').show();
                //Oculta la ventana
                $('.btnocultar').on('click', function () {
                    $('#crearPersonaModal').removeAttr('style');
                })
                //Click cerrar de la ventana emergente
                $('.close').on('click', function () {
                    $('#crearPersonaModal').removeAttr('style');
                })
            })
            //Obtiene los datos del cliente para actualizar 
            $('.btnActuUsuario').click(function () {
                //Identificador
                var value = $(this).val();
                //Función para mostrar los datos
                actualizar(value);
            })
            //Crear clientes
            $('#crearPersona').on('submit', function (e) {
                e.preventDefault();
                //Obtiene todos los datos del FORM
                var data = new FormData(this);
                //Como el vendedor solo puede controlar clientes
                //Se le agrega el tipo cliente
                //A diferencia del administrador que tiene cliente/usuario
                data.append('txtTipo', "Cliente");
                //Llama la función para crear el cliente, le envía como parámetro
                //todos los datos nuevos
                crearCliente(data);
            })
            //Elimina el cliente
            $('.btnElimUsuario').click(function () {
                //Obtiene el identificador
                var value = $(this).val();
                //Llama la funcion para eliminar
                eliminarCliente(value);
            })
        }
    })
}
//Función para eliminar cliente
function eliminarCliente(value) {
    $.ajax({
        url: '/Administrador/EliminarUsuario',
        type: 'POST',
        dataType: 'json',
        data: { value: value },
        beforeSend: function (xhr, type) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (data) {
            if (data.ok != null) {
                Swal.fire(
                    'Eliminado!',
                    'Correctamente!',
                    'success'
                )
                setTimeout(function () {
                    var URLactual = window.location;
                    $(location).attr('href', URLactual);
                }, 2000);
            }
        }
    })
}
//Función para crear clientes
function crearCliente(value) {
    $('#crearPersona').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/Administrador/CrearPersona',
            type: 'POST',
            dataType: 'json',
            data: value,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (xhr, type) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (data) {
                if (data.ok != null) {
                    Swal.fire(
                        'Registrado!',
                        'Correctamente!',
                        'success'
                    )
                    setTimeout(function () {
                        var URLactual = window.location;
                        $(location).attr('href', URLactual);
                    }, 2000);
                }
                if (data.Empty != null) {
                    Swal.fire(
                        'Error!',
                        'No se permiten campos vacios!',
                        'error'
                    )
                }
            }
        })
    })
}
//Función para actualizar cliente
//Esto solo obtiene los datos detallados y los muestra en una ventana emergente
function actualizar(value) {
    $.ajax({
        url: '/Administrador/obtenerusuario',
        type: 'POST',
        dataType: 'json',
        data: { value: value },
        beforeSend: function (xhr, type) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (data) {
            //Muestra los datos del cliente en el frontend
            $('#detalles').html(data);
            //Muestra el popup
            $('#myModal').show();
            //Oculta el modal
            $('.btnocultar').on('click', function () {
                $('#myModal').removeAttr('style');
            })
            //Cierra el modal
            $('.close').on('click', function () {
                $('#myModal').removeAttr('style');
            })
            //Función para actualizar los datos del cliente
            $('#actualizarUsuario').on('submit', function (e) {
                e.preventDefault();
                //Obtiene todos los nuevos datos del form
                var formData = new FormData(this);
                //Le agrega el identificador
                formData.append('id', value)
                $.ajax({
                    url: '/Administrador/ActualizarUsuario',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function (xhr, type) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    },
                    success: function (data) {
                        if (data.actualizado != null) {
                            Swal.fire(
                                'Actualizado!',
                                'Correctamente!',
                                'success'
                            )
                            setTimeout(function () {
                                var URLactual = window.location;
                                $(location).attr('href', URLactual);
                            }, 2000);
                        }
                    }
                })
            })
        }
    })
}