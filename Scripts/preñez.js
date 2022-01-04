//Guardar Cliente

listaPreñez();

$("#addPreñez").submit(function (event) {
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
        url: "../Controladores/preñez_controlador .php?action=guardar", 
        data: parametros,
    }).done(function(respuesta){ 
                console.log("Estos datos retorna: ",respuesta);
                $("#int_bovino_fk").val("");
                $("#dat_fecha_monta").val(""); 
                $("#dat_fecha_parto").val("");
                $("#dat_fecha_celo").val("");

                if (respuesta[0]=="error") {
                    console.error("Ocurrio un error");
                    Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    });
                }
               // actualizarClientes();
            
        }).always(function() {
            $('#modalAddPreñez').modal('hide');                
                    Toast.fire({
                    icon: 'success',
                    title: 'Datos Registrados Correctamente.'
                    })
                
        }).fail(function(){              
                   Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    })
                
            });
});

function listaPreñez(){
      var datos = {"consultar_info":"este_es_el_valor"};
      $.ajax({
          dataType: "json",
          method: "POST",
          url:'../Controladores/preñez_controlador .php',
          data : datos,
      }).done(function(json) {

        //console.log("Estos datos retorna: ",json);
        $("#tablaCl").empty().html(json[0]);
      });
    }



