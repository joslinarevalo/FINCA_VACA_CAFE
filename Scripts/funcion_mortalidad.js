$(function (){
	var fecha_hoy = new Date(); 
	$('#fehca_baja').datepicker({
	    format: "dd/mm/yyyy",
	    todayBtn: true,
	    clearBtn: false,
	    language: "es",
	    calendarWeeks: true,
	    autoclose: true,
	    todayHighlight: true,
	    endDate:fecha_hoy
	});
	cargar_datos();
	


	$(document).on("click",".btn_cerrar_class",function(e){
		e.preventDefault();
		$("#formulario_registroM").trigger('reset');
		$('#md_registrar_mortalidad').modal('hide');

	});
	
	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		//mostrar_mensaje("Consultando datos");
		var id_baja = $(this).attr("data-id_baja");
		console.log("El id es: ",id_baja);
		var datos = {"consultar_info":"si_este_id","id_baja":id_baja}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'../Controladores/JSON_Mortalidad.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {
	    		var fecHA_string = json[2]['fehca_baja'];
				var porciones = fecHA_string.split('-');
				var fecha = porciones[2]+"/"+porciones[1]+"/"+porciones[0]	    	
	    		$('#llave_baja').val(id_baja);
	    		$('#ingreso_datos').val("si_actualizalo");
	    		$('#idexpeiente_baja').val(json[2]['idexpeiente_baja']);
	    		$('#fehca_baja').val(fecha);
	    		$('#descripcion_baja').val(json[2]['descripcion_baja']);
	    		$('#md_registrar_mortalidad').modal('show');
	    	}

	    	 
	    }).fail(function(){

	    }).always(function(){
	    	Swal.close();
	    });


	});
$('#formulario_registroM').validate({
	    rules: {	     
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


	$(document).on("submit","#formulario_registroM",function(e){
		e.preventDefault();
		var datos = $("#formulario_registroM").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 7000
    	});
		if ($("#idexpeiente_baja").val() == "Seleccione"){
 			Toast.fire({
		        icon: 'info',
		        title: 'Debe elegir el bovino'
		    });
			return;
 		}
		console.log("Imprimiendo datos: ",datos);
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/JSON_Mortalidad.php',
            data : datos,
        }).done(function(json) {
			console.log("EL GUARDAR",json);
        	if(json[0]=="Exito"){
	        	$('#md_registrar_mortalidad').trigger('reset');
	        	$('#md_registrar_mortalidad').modal('hide');
        	}
        	
        	
        
        		cargar_datos();
        }).fail(function(){

        }).always(function(){

        });
	});
});



function cargar_datos(){
	//mostrar_mensaje("Consultando datos");
   var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/JSON_Mortalidad.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]);
    	 $('#tabla_baja').DataTable();
    	$('#md_registrar_mortalidad').modal('hide');
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
