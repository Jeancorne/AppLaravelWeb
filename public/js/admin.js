$(document).ready(function () {
    //llamar la función para obtener la tabla con los datos
    get_datos();
    //Cerrar sesión
    $('.btnDeslogear').on('click', function(){
        cerrar_sesion();
    })
})
//Function para cerrar sesión
function cerrar_sesion(){    
    $.ajax({
        url: '/Administrador/cerrar',
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr, type) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        success:function(data){
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
function get_datos(valor) {   
    //Obtiene el tipo de rol, cliente o usuario
    var tipo = $('.tipo').val();  
    //Obtiene el valor para filtrar en busqueda
    var filtro = valor;
    $.ajax({
        url: '/Administrador/filtrar',
        type: 'POST',
        dataType: 'json',
        data: { filtro: filtro, tipo: tipo },
        beforeSend: function (xhr, type) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (data) {    
            //Obtiene la tabla y la pone en el frontend        
            $('.replace').html(data);            
            //Botón para filtrar datos
            $('.btnFiltrar').click(function(){
                //Obtiene el valor que escribieron
                var value = $('.btnBuscar').val();
                //Llama la función para que filtre y envía el valor escrito
                get_datos(value);  
            })            
            //Botón para obtener los datos con detalle del usuario/cliente
            $('.btnActuUsuario').click(function () {
                //Obtiene el identificador
                var value = $(this).val();
                //llama la función para mostrar los detalles y envía el parámetro
                actualizar(value);
            })
            //Botón que muestra el Popup para registrar clientes/usuarios
            $('.btnCrearUsuario').click(function () {
                //Muestra el modal para crear personas
                $('#crearPersonaModal').show();
                //Oculta el modal para crear personas
                $('.btnocultar').on('click', function () {
                    //Elimina el style para ocultarlo
                    $('#crearPersonaModal').removeAttr('style');
                })
                //Click de cerrar el modal
                $('.close').on('click', function () {
                    //Elimina el style para ocultarlo
                    $('#crearPersonaModal').removeAttr('style');
                })
            })
            //Botón del popup de crear cliente/usuario
            $('#crearPersona').on('submit', function (e) {
                //Detiene la ejecución
                e.preventDefault();
                //Obtiene todos los datos del FORM
                var data = new FormData(this);
                //Llama la función que registra y envía los datos
                crearPersona(data);
            })
            //Elimina el usuario
            $('.btnElimUsuario').click(function () {
                //Obtiene el identificador
                var value = $(this).val();
                //Llama la función y envía el parámetro
                eliminarPersona(value);
            })
        }
    })
}
//Función que elimina un usuario/cliente
function eliminarPersona(value) {
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
//Función para crear usuario/cliente
function crearPersona(value) {
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
//Función para mostrar los detalles del usuario/cliente
//Posteriormente se puede actualizar
// Solo muestra los datos detallados del cliente/usuario en un PopUp
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
            //Pinta en el frontend los datos detallados
            $('#detalles').html(data);
            //Muestra el PopUp de detalles
            $('#myModal').show();
            //Oculta el popup de detalles
            $('.btnocultar').on('click', function () {
                //Oculta el modal
                $('#myModal').removeAttr('style');
            })
            //Click cerrar del modal
            $('.close').on('click', function () {
                //Oculta el modal
                $('#myModal').removeAttr('style');
            })
            //Click del botón actualizar del modal
            //Sirve para actualizar los datos del cliente/usuario
            $('#actualizarUsuario').on('submit', function (e) {
                e.preventDefault();
                //Obtiene los datos del form
                var formData = new FormData(this);
                //Agrega el identificador al form
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