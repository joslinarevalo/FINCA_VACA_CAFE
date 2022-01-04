$(function (){	
	cargar_datos();	

	$('#formulario_registro').validate({
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


	
	$(document).on("change","#imagen_persona",function(e){
		validar_archivo($(this));

	});
	

	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		var id = $(this).attr("data-idusuario");		
		var email_empleado = $(this).attr("data-email_empleado");
		console.log("El id es: ",id);
		console.log("El id emil es: ",email_empleado);

		var datos = {"consultar_info":"si_coneste_id","id":id,"correo_emp":email_empleado}

		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/usuarios_controlador.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {	    		

	    		$('#llave_usuario').val(id);
	    		$('#ingreso_datos').val("si_actualizalo");
	    		$('#empleado_usuario').empty().html(json[3][0]);
	    		$('#nombre_usuario').val(json[2]['nva_nom_usuario']);
	    		$('#contrasena_usuario').val(json[2]['nva_contraseña_usuario']);
	    		$('#recontrasena_usuario').val(json[2]['nva_contraseña_usuario']);
	    		$('#correo_usuario').val(email_empleado);	    		
	    		$('#md_edit_usuario').modal('show');
	    		
	    	}
	    	 
	    }).fail(function(){

	    }).always(function(){

	    });


	});

	$(document).on("submit","#formulario_registro",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 7000
    	});
    	if ($("#contrasena_usuario").val() != $("#recontrasena_usuario").val()) {

 			Toast.fire({
		        icon: 'info',
		        title: 'Las contraseñas no coinciden!'
		    });
			return;
 		}else if ($("#empleado_usuario").val() == "Seleccione"){
 			Toast.fire({
		        icon: 'info',
		        title: 'Debe Elegir un Empleado'
		    });
			return;
 		}
		console.log("Imprimiendo datos: ",datos);
		mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/usuarios_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {	    	 	
				Toast.fire({
	            	icon: 'success',
	            	title: 'Usuario modificado exitosamente!.'
       			}); 				
				cargar_datos();
				$('#md_edit_usuario').modal('hide');
	    	}else{
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'Error al modificar!'
		        });
	    	}
        	
        	
        });


	});
});

function cargar_datos(){
	mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/usuarios_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]); 
    	$('#md_registrar_usuario').modal('hide');    	
    }).fail(function(){

    }).always(function(){
    	Swal.close();
    });
}

function mostrar_mensaje(titulo,mensaje=""){
	Swal.fire({
	  title: titulo,
	  html: mensaje,
	  allowOutsideClick: false,
	  timerProgressBar: true,
	  didOpen: () => {
	    Swal.showLoading()
	     
	  },
	  willClose: () => {
	    
	  }
	}).then((result) => {
	  
	   
	})
}


/*
function subir_archivo(archivo,id_persona){

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

  console.log("aca archivos",archivo,id_persona);
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
        url: "json_usuarios.php?id="+id_persona+'&subir_imagen=subir_imagen_ajax',  
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
        	  
            }else{
                Swal.fire(
		          '¡Error!',
		          'No ha sido posible registrar la imagen',
		          'error'
		        );
            }

        }
    });
}




/*

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



}*/