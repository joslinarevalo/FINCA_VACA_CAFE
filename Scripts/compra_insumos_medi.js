	var impuesto=18;
	var cont=0;
	var detalles=0;
	var subtotal_todos = 0;
$(function (){	

	cargar_taba_productos();
	var fecha_hoy = new Date();
	$(".form_datetime").datetimepicker({
		format: 'd-mm-yyyy HH:ii:ss',
		endDate: fecha_hoy,
		todayBtn: true
	});
	
	$('#formulario_registro_compra').validate({
	    rules: {	     
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	});


	$(document).on("submit","#formulario_registro_compra",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro_compra").serialize();
		var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});
    	
    	if ($("#proveedores_compra").val() == "Seleccione"){
 			Toast.fire({
		        icon: 'info',
		        title: 'Debe elegir un Proveedor'
		    });
			return;
 		} 		
		console.log("Imprimiendo datos: ",datos);
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'../Controladores/compra_insumosmedi_controlador.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);        	
	        if (json[0]=="Exito") {
	        	limpiar();	    	 	
				Toast.fire({
	            	icon: 'success',
	            	title: 'Compra registrada exitosamente!.'
       			});
       			var timer = setInterval(function(){
					$(location).attr('href','../Vistas/v_registro_compras.php');
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
		            title: 'No ha productos ha seleccionado productos!'
		        });
	    	}
        	
        	
        });


	});

	//selecionando y añadiento el producto a la lista del detalle


	$(document).on("click",".btn_seleccionado",function(e){ 
        e.preventDefault();
        var elemento = $(this);
        var data_iditem = elemento.attr('data-idproducto_seleccionado');
		var data_nombreitem = elemento.attr('data-nombre_item_selec');
		
        console.log("viene este id: ",data_iditem);
        console.log("producto: ",data_nombreitem);
        var Toast = Swal.mixin({
	        toast: true,
	        position: 'top-end',
	        showConfirmButton: false,
	        timer: 5000
    	});

       	var cantidad=1;
		var costo_item_compra=1;
		var precio_venta=1;
		if (data_iditem) {
			var subtotal=cantidad*costo_item_compra;
			var fila='<tr class="filas" id="fila'+cont+'">'+	        
	        '<td><input type="hidden" class="form-control" id="idproducto[]" name="idproducto[]" value="'+data_iditem+'">'+data_nombreitem+'</td>'+

	        '<td><input type="number" autocomplete="off" class="form-control" name="costo_item_compra[]" id="costo_item_compra[]" value="'+costo_item_compra+'"></td>'+

	        '<td><input type="number" autocomplete="off" class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+

	        '<td class="text-center"><span id="subtotal'+cont+'" name="subtotal" >'+subtotal+'</span>'+

	        '<input type="hidden" class="form-control" name="listado_detallle" id="listado_detallle" value="'+cont+'">'+

	        '<input type="hidden" class="form-control" name="subtotal_guardar[]"  id="subtotal_guardar[]" value="'+subtotal+'">'+'</td>'+

	        '<td class="text-center project-actions"><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-sync-alt"></i></button>'+
	        
	        	'<button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fas fa-trash"></i></button>'+
	        '</td>'+
			'</tr>';
			cont++;
			subtotal_todos = subtotal_todos + subtotal;
			detalles++;
			$("#Subtotal_compra_vista").val("$"+subtotal_todos);
			$('#tablaDetalleDerivados').append(fila);
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

    $('.validcion_solo_numeros_fact').keypress(function(e) {

        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0 || tecla==9)  return true;
        // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
  	});
  	 $('.fecha_compra_val').keypress(function(e) {

        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0 || tecla==9 || tecla==47 || tecla==58)  return true;
        // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
  	});
  	

     
});


function modificarSubtotales(){
	var cant=document.getElementsByName("cantidad[]");
	var prec=document.getElementsByName("costo_item_compra[]");
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

	$("#Subtotal_compra_vista").val("$"+subt);
	$("#subtotal_guardar").val(subt);
	$("#total_compra_vista").val("$"+total);
	$("#total_compra_guardar").val(total);
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

function limpiar(){

	$("#formulario_registro_compra").trigger('reset');	
	$(".filas").remove();
}

function cargar_taba_productos(){
	//mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/compra_insumosmedi_controlador.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#tb_seleccion_productos").empty().html(json[1]);
    	$('#example1').DataTable();

    	$("#proveedores_compra").empty().html(json[5][0]);    	
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });
}