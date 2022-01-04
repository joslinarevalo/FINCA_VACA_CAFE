//Guardar Cliente



$("#addExpediente").submit(function (event) {
    var parametros = $(this).serialize();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $.ajax({
        type: "POST",
        url: "../Controladores/expediente_Controlador.php?action=guardar", 
        data: parametros,
    }).done(function(respuesta){ 
                console.log("Estos datos retorna: ",respuesta);
                $("#nombre_b").val("");
                $("#estado_b").val(""); 
                $("#sexo_b").val(""); 
                $("#cantidad_parto").val(""); 
                $("#descripcion_b").val(""); 
                $("#propietario").val(""); 
                $("#cmb_raza").val("");
                $("#t_bovino").val(""); 
                $("#fecha_ul_parto").val(""); 
                if (respuesta[0]=="error") {
                    console.error("Ocurrio un error");
                    Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    });
                }           //   actualizarClientes();
            
        }).always(function() {            
                Toast.fire({
                icon: 'success',
                title: 'Datos Registrados Correctamente.'
                })
            
        }).fail(function(){           
            Toast.fire({
            icon: 'error',
            title: 'Error!.'
            });
        });

    event.preventDefault();
});



 $(function () {
    var Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
      showConfirmButton: false,
       timer: 3000
    });
});