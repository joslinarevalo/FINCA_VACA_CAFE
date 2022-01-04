listaProducto();
$("#addProducto").submit(function (event) {
    event.preventDefault(); 
    var parametros = $(this).serialize();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "../Controladores/producto_controlador.php", 
        data: parametros,
    }).done(function(respuesta){ 
                console.log("Estos datos retorna: ",respuesta);
                $("#nombre_Producto").val("");
                $("#existencia_Producto").val(""); 
                $("#precio_Producto").val("");
                $("#descrip_Producto").val("");
                $("#fechav_Producto").val(""); 
                $("#categoria_Producto").val(""); 
                if (respuesta[0]=="error") {
                    console.error("Ocurrio un error");
                    Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    });
                }
               listaProducto();
            
        }).always(function() {
            $('#modalAddProducto').modal('hide');                
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

function listaProducto(){
      var datos = {"consultar_info":"este_es_el_valor"};
      $.ajax({
          dataType: "json",
          method: "POST",
          url:'../Controladores/producto_controlador.php',
          data : datos,
      }).done(function(json) {

        //console.log("Estos datos retorna: ",json);
        $("#tablaPro").empty().html(json[0]);
      });
}

//Abrir Modal Editar Equipo
$('#modalProductoEdit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    
    var namepro = button.data('namepro')
    $('#nombre_Producto_edit').val(namepro)

    var exispro = button.data('exispro')
    $('#existencia_Producto_edit').val(exispro)

    var costopro = button.data('costopro')
    $('#precio_Producto_edit').val(costopro)

    var descpro = button.data('descpro')
    $('#descrip_Producto_edit').val(descpro)

    var fechapro = button.data('fechapro')
    $('#fechav_Producto_edit').val(fechapro)

    /*var catepro = button.data('catepro')
    $('#categoria_Producto_edit').val(catepro)*/

    var idpro = button.data('idpro')
    $('#id_Producto_edit').val(idpro)
});
//Editar Producto
$("#editProducto").submit(function (event) {
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
        url: "../Controladores/producto_controlador.php", 
        data: parametros,
    }).done(function(respuesta){ 
            console.log("Estos datos retorna: ",respuesta);
             $("#nombre_Producto_edit").val("");
                $("#existencia_Producto_edit").val(""); 
                $("#precio_Producto_edit").val("");
                $("#descrip_Producto_edit").val("");
                $("#fechav_Producto_edit").val(""); 
                $("#categoria_Producto_edit").val(""); 

        if (respuesta[0]=="error") {
            console.error("Ocurrio un error");
            Toast.fire({
                icon: 'error',
                title: 'Error!.'
            });
        }               
        listaProducto();
    }).always(function() {
        $('#modalProductoEdit').modal('hide');                
        Toast.fire({
            icon: 'success',
            title: 'Datos Modificados Correctamente.'
        });                   
                
    }).fail(function(){              
        Toast.fire({
            icon: 'error',
            title: 'Error en la Modificación de la consulta!.'
        });
         listaProducto();
    });
});


//Abrir Modal Advertencia
$('#modalBajaProducto').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal

    var idprobaja = button.data('idprobaja')   
    $('#id_baja').val(idprobaja)
});

//Baja Producto
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
        url: "../Controladores/producto_controlador.php", 
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
        listaProducto();
    }).always(function() {
        $('#modalBajaProducto').modal('hide');                
        Toast.fire({
            icon: 'success',
            title: 'Se dió de baja correctamente.'
        });                   
                
    }).fail(function(){              
        Toast.fire({
            icon: 'error',
            title: 'Error no se donde!.'
        });
        listaProducto();
    });
});
