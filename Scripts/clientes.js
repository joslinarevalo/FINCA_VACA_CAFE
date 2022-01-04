

listaClientes();
//Guardar Cliente
$("#addCliente").submit(function (event) {
    event.preventDefault(); 
    var parametros = $(this).serialize();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "../Controladores/clientes_controlador.php?action=guardar", 
        data: parametros,
    }).done(function(respuesta){ 
                console.log("Estos datos retorna: ",respuesta);
                $("#dui_cliente").val("");
                $("#nombre_Cliente").val(""); 
                $("#apellido_Cliente").val("");
                $("#direc_cliente").val("");
                $("#telefono_Cliente").val("");

                if (respuesta[0]=="error") {
                    console.error("Ocurrio un error");
                    Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    });
                }
               listaClientes();
            
        }).always(function() {
            $('#modalAddCliente').modal('hide');                
                    Toast.fire({
                    icon: 'success',
                    title: 'Datos Registrados Correctamente.'
                    })
                
        }).fail(function(){              
                   Toast.fire({
                    icon: 'error',
                    title: 'Error al gurdar en la consulta!.'
                    })
                
            });
});

function listaClientes(){
      var datos = {"consultar_info":"este_es_el_valor"};
      $.ajax({
          dataType: "json",
          method: "POST",
          url:'../Controladores/clientes_controlador.php',
          data : datos,
      }).done(function(json) {

        //console.log("Estos datos retorna: ",json);
        $("#tablaCl").empty().html(json[0]);
      });
}

//Abrir Modal Editar Equipo
$('#modalClienteEdit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    
    var duiclt = button.data('duiclt')
    $('#dui_cliente_edit').val(duiclt)

    var nombreclt = button.data('nombreclt')
    $('#nombre_Cliente_edit').val(nombreclt)

    var apellidoclt = button.data('apellidoclt')
    $('#apellido_Cliente_edit').val(apellidoclt)

    var direcclt = button.data('direcclt')
    $('#direc_cliente_edit').val(direcclt)

    var teledonoclt = button.data('teledonoclt')
    $('#telefono_Cliente_edit').val(teledonoclt)

    var idclt = button.data('idclt')
    $('#id_cliente_edit').val(idclt)
});
//Editar Cliente
$("#editClientes").submit(function (event) {
    event.preventDefault(); 
    var parametros = $(this).serialize();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "../Controladores/clientes_controlador.php", 
        data: parametros,
    }).done(function(respuesta){ 
            console.log("Estos datos retorna: ",respuesta);
            $("#dui_cliente_edit").val("");
            $("#nombre_Cliente_edit").val(""); 
            $("#apellido_Cliente_edit").val("");
            $("#direc_cliente_edit").val("");
            $("#telefono_Cliente_edit").val("");

        if (respuesta[0]=="error") {
            console.error("Ocurrio un error");
            Toast.fire({
                icon: 'error',
                title: 'Error!.'
            });
        }               
        listaClientes();
    }).always(function() {
        $('#modalClienteEdit').modal('hide');                
        Toast.fire({
            icon: 'success',
            title: 'Datos Modificados Correctamente.'
        });                   
                
    }).fail(function(){              
        Toast.fire({
            icon: 'error',
            title: 'Error en la Modificación de la consulta!.'
        });
         listaClientes();
    });
});


//Abrir Modal Advertencia
$('#modalBajaCliente').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal

    var idcltbaja = button.data('idcltbaja')   
    $('#id_baja').val(idcltbaja)
});

//Baja Cliente
$("#confirmaBaja").submit(function (event) {
    event.preventDefault(); 
    var parametros = $(this).serialize();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "../Controladores/clientes_controlador.php", 
        data: parametros,
    }).done(function(respuesta){ 
            console.log("Estos datos retorna: ",respuesta);
            $("#id_baja").val("");            

        if (respuesta[0]=="error") {
            console.error("Ocurrio un error");
            Toast.fire({
                icon: 'error',
                title: 'Error!.'
            });
        }               
        listaClientes();
    }).always(function() {
        $('#modalBajaCliente').modal('hide');                
        Toast.fire({
            icon: 'success',
            title: 'Se dió de baja correctamente.'
        });                   
                
    }).fail(function(){              
        Toast.fire({
            icon: 'error',
            title: 'Error no se donde!.'
        });
        listaClientes();
    });
});