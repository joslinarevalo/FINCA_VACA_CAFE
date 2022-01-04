$(function(){


	//$('#formulario_desbloqueo1').parsley();
	
	$('#formulario_desbloqueo').validate({
		    rules: {
		      password: {
		        required: true,
		        minlength: 5
		      },
		    },
		    messages: {
		      password: {
		        required: "Please provide a password",
		        minlength: "Your password must be at least 5 characters long"
		      }		     
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

	$(document).on("submit","#formulario_desbloqueo",function(event){
		event.preventDefault();
		var datos = $("#formulario_desbloqueo").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
		console.log("formulario desbloqueo",datos);
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/inicio_sesion_controlador.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log(" desbloqueo",json);
	    	if (json[0]=="Exito") {
	    	 	
				Toast.fire({
            	icon: 'success',
            	title: 'Desbloqueado!.'
       			}); 
				var timer = setInterval(function(){
					$(location).attr('href','../Vistas/v_principal.php');
					clearTimeout(timer); 
				},3500)
	    	}else{
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'Contraseña Incorrecta!'
		        });;
	    	}

	    });
	});

	
});