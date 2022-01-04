$(function (){
	console.log("funcionando");
	cargar_datos();

	var fecha_hoy = new Date(); 
	$('#fechav_Producto').datepicker({
	    format: "dd-mm-yyyy",
	    todayBtn: true,
	    clearBtn: false,
	    language: "es",
	    calendarWeeks: true,
	    autoclose: true,
	    todayHighlight: true,
	    startDate:fecha_hoy
	});

$('#addProducto').validate({
	    rules: {
	      email: {
	        required: true,
	        email: true,
	      },
	      password: {
	        required: true,
	        minlength: 5
	      },
	      terms: {
	        required: true
	      },
	    },
	    messages: {
	      email: {
	        required: "Por favor ingresa un email",
	        email: "Por favor ingresa un email valido"
	      },
	      password: {
	        required: "Please provide a password",
	        minlength: "Your password must be at least 5 characters long"
	      },
	      terms: "Please accept our terms"
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.input-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	});

   



	$(document).on("change","#imagen_expediente",function(e){
		validar_archivo($(this));

	});

	
	//este eliminar
	$(document).on("click",".btn_baja",function(e){
		e.preventDefault();
		var id = $(this).attr("data-idcltbaja");
		var idpro_baja =$('#id_producto_baja').val(id); 
		$('#modalBajaProducto').modal('show');
		
	});
	$(document).on("submit","#confirmaBaja",function(e){
		e.preventDefault();
		var datos = $("#confirmaBaja").serialize();
		console.log("Imprimiendo datos: ",datos);
		console.log("#estado_productos");
		 var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 700000000
    	});
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/productos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	cargar_datos();
        	 if (json[0]=="Exito") {
                	$('#modalBajaProducto').modal('hide');
	        		cargar_datos();
	        		Toast.fire({
                    icon: 'success',
                    title: 'Producto dado de baja con Exito!.'
                     });
                }else{                	
                    Toast.fire({
                    icon: 'error',
                    title: 'Error no se pudo actualizar!.'
                    });
                }
        });
    });

	//este editar
	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		var id = $(this).attr("data-idproducto");
		var idCat= $(this).attr("data-nombrecategoria");		
		console.log("El id es: ",id);
		var datos = {"consultar_info":"si_coneste_id","id":id,"nombre_categoria":idCat}

		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/productos_controlador.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {	 

	    		
	    		console.log("imagen_productos: ",json[2]['nva_image_producto']);
	    	   var fecHA_string = json[2]['dat_fecha_vencimiento'];
				var porciones = fecHA_string.split('-');
				var fecha = porciones[2]+"-"+porciones[1]+"-"+porciones[0] 
	    		$('#llave_producto').val(id);
	    		$('#almacenar_datos').val("si_actualizalo");
	    		$('#categoria_Producto').empty().html(json[3][0]);
	    		$('#nombre_Producto').val(json[2]['nva_nom_producto']);
	    		$('#descrip_Producto').val(json[2]['txt_descrip_producto']);
	    		$('#fechav_Producto').val(fecha);
	    		$('#precio_Producto').val(json[2]['dou_costo_producto']);
	    		$('#costo_Producto').val(json[2]['dou_precio_venta_producto']);
	    		$('#existencia_Producto').val(json[2]['int_existencia']);
	    		$('#imagen_productos').empty().html(json[2]['nva_image_producto']);
	    		$("#radio_activo").prop("disabled", false); 
	    		$("#radio_inactivo").prop("disabled", false); 		
	    		$('#mod_add_producto').modal('show');
	    	}
	    	 
	    }).fail(function(){

	    }).always(function(){
	    	Swal.close();
	    });

	});

	$(document).on("click","#btn_nuevo_producto",function(e){
		e.preventDefault();
		$("#mod_add_producto").modal("show");
	});

//categoria
	$(document).on("click","#btn_nueva_categoria",function(e){
		e.preventDefault();
		$("#mod_add_categoria").modal("show");
	});

	$(document).on("click","#registrar_producto",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal
		$('#mod_add_producto').modal('show');

		$(".select2").select2({
	    }).on("select2:opening", 
	        function(){
	            $(".modal").removeAttr("tabindex", "-1");
	    }).on("select2:close", 
	        function(){ 
	            $(".modal").attr("tabindex", "-1");
	    });
    
	});

//categoria
$(document).on("click","#registrar_categoria",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal
		$('#mod_add_categoria').modal('show');

		$(".select2").select2({
	    }).on("select2:opening", 
	        function(){
	            $(".modal").removeAttr("tabindex", "-1");
	    }).on("select2:close", 
	        function(){ 
	            $(".modal").attr("tabindex", "-1");
	    });
    
	});


	$(document).on("submit","#addProducto",function(e){
		e.preventDefault();
		var datos = $("#addProducto").serialize();
		console.log("Imprimiendo datos: ",datos);
		console.log("#estado_productos");
		 var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000
    	});
		if ($("#categoria_Producto").val() == "Seleccione"){
		 			Toast.fire({
				    icon: 'info',
				    title: 'Debe elegir una categoria'
				    });
					return;
 		        }
 		        if ($("#imagen_productos").val() == ""){
		 			Toast.fire({
				    icon: 'info',
				    title: 'Debe elegir una imagen de producto'
				    });
					return;
 		        }
		//mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/productos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	cargar_datos();
        	 if (json[0]=="Exito") {
                	$("#nombre_Producto").val("");
	                $("#descrip_Producto").val(""); 
	                $("#fechav_Producto").val("");
	                $("#precio_Producto").val("");
	                $("#costo_Producto").val("");
	                $("#existencia_Producto").val("");
	                $("#categoria_Producto").val("");
	               // console.log("el id del producto",json[1]);
	                if ($("#imagen_productos").val()!="") { 
	        			subir_archivo($("#imagen_productos"),json[1]);
	        		}else{
	        			mostrar_mensaje("Error","algo paso");
	        		}
	        		cargar_datos();
	        		Toast.fire({
                    icon: 'success',
                    title: 'Producto registrado con Exito!.'
                     });
                }else if(json[0]=="exito"){
                	cargar_datos();
                    Toast.fire({
                    icon: 'success',
                    title: 'Producto modificado con Exito!.'
                     });
                }else{
                	console.error("Ocurrio un error");
                    Toast.fire({
                    icon: 'error',
                    title: 'Error!.'
                    });
                }
        	return false;
        });
    });

//categoria
    $(document).on("submit","#addCategoria",function(e){
		e.preventDefault();
		var datos = $("#addCategoria").serialize();
		console.log("Imprimiendo datos: ",datos);
		 var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000
    	});
		 if ($("#categoria_Producto").val() == ""){
		 			Toast.fire({
				    icon: 'info',
				    title: 'Por favor ingrese una categoria'
				    });
					return;
 		        }
		//mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/productos_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	 if (json[0]=="Exito") {
                	$("#nombre_Categoria").val("");
					//cargar_datos();
					$('#mod_add_categoria').modal('hide');
					//cargar_datos();
                    Toast.fire({
                    icon: 'success',
                    title: 'Categoria registrado con Exito!.'
                     });
                }
        });

    });
});

     //Guardar Prducto

function validar_archivo(file){
	console.log("validar_archivo",file);
	 
     var Lector;
     var Archivos = file[0].files;
     var archivo = file;
     var archivo2 = file.val();
     if (Archivos.length > 0) {


        Lector = new FileReader();
        Lector.onloadend = function(e) {
            var origen, tipo, tamanio;
            //Envia la imagen a la pantalla
            origen = e.target; //objeto FileReader
            //Prepara la información sobre la imagen

            tipo = archivo2.substring(archivo2.lastIndexOf("."));
            console.log("el tipo",tipo);
            tamanio = e.total / 1024;
            console.log("el tamaño",tamanio);

            if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
                //  
                console.log("error_tipo");
                $("#error_en_la_imagen").css('display','block');
            }
            else{
                 $("#error_en_la_imagen").css('display','none');
                console.log("en el else");
            }

       };
        Lector.onerror = function(e) {
        console.log(e)
       }
       Lector.readAsDataURL(Archivos[0]);
	}
}

function subir_archivo(archivo,int_idproducto){

	Swal.fire({
      title: '¡Subiendo imagen!',
      html: 'Por favor espere mientras se sube el archivo',
      timerProgressBar: true,
      allowEscapeKey:false,
      allowOutsideClick:false,
      onBeforeOpen: () => {
        Swal.showLoading()
      }
  	});

  console.log("aca archivos",archivo,int_idproducto);
  // return null;
    var file =archivo.files;
    var formData = new FormData();
    formData.append('formData', $("#crear_seccion_home"));
    var data = new FormData();
     //Append files infos
     jQuery.each(archivo[0].files, function(i, file) {
        data.append('file-'+i, file);
     });

     console.log("data",data);
     $.ajax({  
        url: "../Controladores/productos_controlador.php?id="+int_idproducto+'&subir_imagen=subir_imagen_ajax',  
        type: "POST", 
        dataType: "json",  
        data: data,  
        cache: false,
        processData: false,  
        contentType: false, 
        context: this,

        success: function (json) {
	          Swal.close();
	            console.log("eljson_img",json);
	            

	        if(json[0]=="Exito"){  
	             Swal.fire(
		          '¡Excelente!',
		          'La información ha sido almacenada correctamente!',
		          'success'
	        	);
	                 	$('#mod_add_producto').modal('hide');
	                 	cargar_datos();

        	  
            }else{
                Swal.fire(
		          '¡Error!',
		          'No ha sido posible registrar la imagen',
		          'error'
		        );
		        $('#mod_add_producto').modal('hide');
	                 	cargar_datos();
            }

        }
    });
}

function cargar_datos(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/productos_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tablaPro").empty().html(json[1]); 
    	$('#mod_add_producto').modal('hide');
    	$('#example1').DataTable(); 
        $("#categoria_Producto").empty().html(json[3][0]);
    }).fail(function(){

    }).always(function(){
    	Swal.close();
    });
}
	





