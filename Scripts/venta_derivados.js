	var impuesto=18;
	var cont=0;
	var detalles=0;
	var subtotal_todos = 0;
	cargar_tabla_productos();
$(function (){	

	var fecha_hoy = new Date();
	$(".form_datetime").datetimepicker({
		format: 'd-mm-yyyy HH:ii:ss',
		endDate: fecha_hoy,
		todayBtn: true
	});
	
	$('#formulario_registro_venta').validate({
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


	$(document).on("submit","#formulario_registro_venta",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro_venta").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
    	
    	if ($("#cliente_venta_d").val() == "Seleccione"){
 			Toast.fire({
		        icon: 'info',
		        title: 'Debe elegir un Clinte'
		    });
			return;
 		} 		
		console.log("Imprimiendo datos: ",datos);
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/venta_derivados_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {
	        	limpiar();
				Toast.fire({
	            	icon: 'success',
	            	title: 'Venta registrada exitosamente!.'
       			});
       			var timer = setInterval(function(){
					$(location).attr('href','../Vistas/r_factura_venta.php');
					clearTimeout(timer);
				},3500);
				

	    	}else if (json[0]=="Error" && json[1]=="existencias"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'No se pudo obtener la exitencia!'
		        });
	    	 	
	    	}else if (json[0]=="Error" && json[1]=="ultimacompra"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'No se pudo obtener la ultima compra!'
		        });
	    	 	
	    	}else if (json[0]=="Error" && json[1]=="en la insercion de la compra"){
	    	 	Toast.fire({
		            icon: 'error',
		            title: 'No se pudo registrar la compra!'
		        });
	    	 	
	    	}else{
	    	 	Toast.fire({
		            icon: 'info',
		            title: 'No ha seleccionado productos!'
		        });
	    	}
        });
	});

	//selecionando y añadiento el producto a la lista del detalle


	$(document).on("click",".btn_item_seleccionado",function(e){ 
        e.preventDefault();
        var elemento = $(this);
        var data_iditem = elemento.attr('data-idproducto_seleccionado');
		var data_nombreitem = elemento.attr('data-nombre_item_selec');
		var data_precioitem = elemento.attr('data-precio_item_selec');
		var data_imgen = elemento.attr('data-nva_image_producto');
		
        console.log("viene este id: ",data_iditem);
        console.log("producto: ",data_nombreitem);
        console.log("precio: ",data_precioitem);
         console.log("imagen: ",data_imgen);
        var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});

       	var cantidad=1;
		var precio_item_venta=1;
		var precio_venta=data_precioitem;
		if (data_iditem) {
			var subtotal=cantidad*precio_item_venta;
			var fila='<tr class="filas" id="fila'+cont+'">'+	        
	        '<td><input type="hidden" class="form-control" id="idproducto_v[]" name="idproducto_v[]" value="'+data_iditem+'">'+data_nombreitem+'</td>'+
	        
	        '<td class="text-center"><img alt="img" width="90" height="100" src="'+data_imgen+'"></td>'+

	        '<td><input type="number" autocomplete="off" class="form-control" name="precio_item_venta[]" id="precio_item_venta[]" value="'+data_precioitem+'"></td>'+

	        '<td><input type="number" autocomplete="off" class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+

	        '<td class="text-center"><span id="subtotal'+cont+'" name="subtotal" >'+subtotal+'</span>'+

	        '<input type="hidden" class="form-control" name="subtotal_guardar[]"  id="subtotal_guardar[]" value="'+subtotal+'">'+'</td>'+

	        '<td class="text-center project-actions"><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-sync-alt"></i></button>'+
	        
	        	'<button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fas fa-trash"></i></button>'+
	        '</td>'+
			'</tr>';
			cont++;
			subtotal_todos = subtotal_todos + subtotal;
			detalles++;
			$("#subtotal_v_venta_d").val("$"+subtotal_todos);
			$('#tablaDetalleVentaD').append(fila);
			modificarSubtotales();
			console.log("vuelve tener est: ",data_iditem);
			
		}else{
			Toast.fire({
		        icon: 'error',
		        title: 'El ID no está llegando!'
		    });
	    	 	
		}
		
    });

    $(document).on("click",".btn_limpiar",function(e){
    	limpiar();
    });
     
});


function modificarSubtotales(){
	var cant=document.getElementsByName("cantidad[]");
	var prec=document.getElementsByName("precio_item_venta[]");
	var sub=document.getElementsByName("subtotal");

	
	for (var i = 0; i < cant.length; i++) {
		var inpC=cant[i];
		var inpP=prec[i];
		var inpS=sub[i];


		inpS.value=inpC.value*inpP.value;
		document.getElementsByName("subtotal")[i].innerHTML=inpS.value;
	}

	calcularTotales();
}

function calcularTotales(){
	var sub = document.getElementsByName("subtotal");
	var subt  = 0.0;
	var total=0.0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
		subt = subt + document.getElementsByName("subtotal")[i].value;
	}

	$("#subtotal_v_venta_d").val("$"+subt);
	$("#subtotal_g_venta_d").val(subt);
	$("#total_v_venta_d").val("$"+total);
	$("#total_g_venta_d").val(total);
	evaluar();
}

function evaluar(){

	if (detalles>0) 
	{
		$("#btnGuardar").show();
	}
	else
	{
		$("#btnGuardar").hide();
		cont=0;
	}
}

function eliminarDetalle(indice){
$("#fila"+indice).remove();
calcularTotales();
detalles=detalles-1;

}

//funcion limpiar
function limpiar(){

	$("#formulario_registro_venta").trigger('reset');	
	$(".filas").remove();
}

function cargar_tabla_productos(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/venta_derivados_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tb_seleccion_derivados").empty().html(json[1]);
    	$('#example1').DataTable();

    	$("#cliente_venta_d").empty().html(json[5][0]);     	
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });
}