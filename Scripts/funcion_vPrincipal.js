
$(function (){	

	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'../Controladores/controlador_principal.php',
        data : datos,
    }).done(function(json) {
    	
    	if (json[0]=="Exito"){
	   
		   $("#alertas_preñez").empty().html(json[1]);
		    	 	
		}/*else if (json[0]=="2"){
		   
		   $("#alert_preñez").empty().html(json[1]);
		    	 	
		}else if (json[0]=="2"){
		   
		   $("#alert_preñez").empty().html(json[1]);
		    	 	
		} */    	
    }).fail(function(){

    }).always(function(){
    	//Swal.close();
    });

	

	
});
