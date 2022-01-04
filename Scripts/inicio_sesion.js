$(function(){
	console.log("todo esta integrado");
	//$("#dui").mask("99999999-9");


	$('#formulario_login').validate({
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



	$(document).on("submit","#actualizar_pass",function(event){
		event.preventDefault();
		if ($("#contrasena").val() != $("#recontrasena").val()) {

 			Swal.fire({
			  icon: 'error',
			  title: "Oops",
			  html:'Las contraseñas no coinciden'
			});
			return;
 		}
		mensaje_advertencia("Procesando solicitud","Por favor espere mientras se actualiza su contraseña");
		var datos = $("#actualizar_pass").serialize();
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_ingreso.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("actualizar pass",json);
	    	if (json[0]=="Exito") {
	    		Swal.close();
	    		Swal.fire({
				  icon: 'success',
				  title: "Su contraseña se ha actualizado",
				  html:"Espere mientras se redirige al login"
				});
				var timer = setInterval(function(){
					$(location).attr('href','index.php?modulo=Home');
					clearTimeout(timer); 
				},3500)
	    	}
	    }).always(function(){
	    	
	    })

	});
	$(document).on("submit","#validando_dui",function(event){
 		event.preventDefault();

		mensaje_advertencia("Procesando solicitud","Por favor no recargue la pantalla");
			
 		
 		var datos = $("#validando_dui").serialize();
 		console.log("datos enviados: ",datos);
 		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_ingreso.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("Dui VALIDADO",json);
	    	if (json[0]=="Exito") {
	    		$("#id_persona").val(json[2]);
	    		//$("#actualizar_pass").css("display","block");
	    		$("#validando_dui").removeClass("mostrar").addClass("hiden");
	    		$("#actualizar_pass").removeClass("hiden").addClass("mostrar");

	    	}else{

	    		Swal.fire({	    		
				icon: 'error',
				title: "El DUI ingresado no existe"
				});
				

	    	}

	    }).always(function(){
	    	Swal.close();
	    });


 	});
	$(document).on("submit","#formulario_login",function(event){
		event.preventDefault();
		var datos = $("#formulario_login").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
		console.log("evento submit",datos); 
		$.ajax({
	        dataType: "json", 
	        method: "POST",
	        url:'../Controladores/inicio_sesion_controlador.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("el login: ",json);
	    	if (json[0]=="Exito") {
	    	 	
				Toast.fire({
            	icon: 'success',
            	title: 'Bienvenido Al Sistema!.'
       			}); 
				var timer = setInterval(function(){
					$(location).attr('href','../Vistas/v_principal.php');
					clearTimeout(timer);
				},3500)
	    	}else if (json[0]=="Error" && json[1]=="La contraseña no coincide"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'Contraseña Incorrecta!'
		        });
	    	 	
	    	}else{
	    	 	Toast.fire({
		            icon: 'info',
		            title: 'No existe este Usuario!'
		        });
	    	}

	    });


	});
})

function mensaje_advertencia(titulo,mensaje=""){
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