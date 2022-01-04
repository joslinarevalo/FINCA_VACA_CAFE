//listaBusqueda();

$(document).ready(function(){  
    // Código para obtener todos los registros de la tabla a través del cuadro de selección
    $("#t_producto").change(function() {    
        var seleccionar = $(this).find(":selected").val();
        var dataString = 'tipo_pro='+ seleccionar;    
        $.ajax({ 
            url: '../Controladores/agregarCompra_controlador.php',
            dataType: "json",
            data: dataString,  
            cache: false,          
        }).done(function(tabla) {

        //console.log("Estos datos retorna: ",json);
        $("#tb_seleccion").empty().html(tabla[0]);
      });
    })
   
});

/*$("#buscaProducto").submit(function (event) {  
    event.preventDefault(); 
    $("#t_producto").change(function() {    
        var sleccionar = $(this).find(":selected").val();
        var parametros = 'tipo_pro='+ sleccionar;    
         $.ajax({
            dataType: "json",
            type: "POST",
            url: "../Controladores/controlador_detallecompra.php", 
            data: parametros,
        }).done(function(respuesta){ 
             
            
        }).always(function() {
           
                
        }).fail(function(){              
                  
        });
    })
   
});*/


function listaBusqueda(){
      var datos = {"consultar_info":"este_es_el_valor"};
      $.ajax({
          dataType: "json",
          method: "POST",
          url:'../Controladores/controlador_detallecompra.php',
          data : datos,
      }).done(function(tabla) {

        //console.log("Estos datos retorna: ",json);
        $("#tb_seleccion").empty().html(tabla[0]);
      });
}
