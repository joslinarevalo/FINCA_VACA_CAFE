

  /*function agregarPro(id){  

     // e.preventDefault();  
          var elemento = $(this);
          var data_id = elemento.val('data-idpro');
          var datos = {"idProducto":id};
          $.ajax({ 
              url: '../Controladores/detalleCompra_controlador.php',
              dataType: "json",
              type: 'POST',
              data: datos,  
              cache: false,          
          success: function (tabla){

          //console.log("Estos datos retorna: ",json);
            $("#tablaDetalle").empty().html(tabla[0]);
          }
        });
    } 
          //return false;
        $.ajax({
          dataType: "json"
            type: 'POST',
            url: "../Controladores/agregarCompra_controlador.php",
            data: "codigo="+id+"&canti="+cant,
            success: function (r){
                $("#tablaDetalle").empty().html(r[0]);            
              });

        });*/

  $(function(){
      console.log("Esta funcionando jquery");

      $(document).on("click",".AgregarPro",function(e){ 
        e.preventDefault();
        var elemento = $(this);
        var data_idpro = elemento.attr('data-idpro');
        console.log("Si se ejecuta",data_idpro);

        var datos = {"AgregarPro":"lleva_el_id","idProducto":data_idpro};
        console.log("los datos enviados: ",datos);
        //return;
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/detalleCompra_controlador.php',
            data : datos,
        }).done(function(tabla) {
          $("#tablaDetalle").empty().html(tabla[0]);
         
        });
      });
      return false;      
  });


