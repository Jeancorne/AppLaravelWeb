$(document).ready(function () {
    //Iniciar sesión
    $('#inicio_sesion').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'loggin',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (xhr, type) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (data) {
                if (data.ok != null) {
                    Swal.fire(
                        'Conectado!',
                        'Correctamente',
                        'success'
                    )
                    setTimeout(function () {                       
                        $(location).attr('href', data.ok);
                    }, 2000);
                }
                if(data.noexiste != null){                   
                    Swal.fire(
                        'Error!',
                        'Correo o contraseña incorrecta',
                        'error'
                    )
                }
            }
        })
    })
    //crear administrador o vendedor
    $('#crear_usuario').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'crear_usuario',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (xhr, type) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (data) {
                if (data.ok != null) {
                    Swal.fire(
                        'Registro!',
                        'Exitoso!',
                        'success'
                    )
                    setTimeout(function () {
                        var url = "index";
                        $(location).attr('href', url);
                    }, 2000);
                }
                if (data.campo_empty != null) {
                    Swal.fire(
                        'Error!',
                        'Todos los campos deben ser llenados',
                        'error'
                    )
                }
            },
            error: function (err) {
                Swal.fire(
                    'Error!',
                    err,
                    'error'
                )
                console.log(err);
            }
        })
    })
})