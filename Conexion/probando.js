	if ($("#tipo_bovino").val() == "vaca_lechera" ) {
			$("#cant_parto_bovino").prop("disabled", false);
			$("#control_fecha").val("no_hay_fecha");
		//	$("#fecha_ult_parto").prop("disabled", false);
			

		} else {
			
			$("#fecha_ult_parto").prop("disabled", true);
			$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	$(document).on("change", "#cant_parto_bovino", function (e) {
		e.preventDefault();

		if ($("#cant_parto_bovino").val() >0 ) {
			$("#cant_parto_bovino").prop("disabled", true);
			$("#control_fecha").val("si_hay_fecha");
			

		}else{
			$("#cant_parto_bovino").prop("disabled", true);
			$("#fecha_ult_parto").prop("disabled", false);
		}
	});

	///se pone can desabilitado con cant mayor a 0 y fecha deesabilitada

		if ($("#tipo_bovino").val() == "vaca_lechera" ) {
			$("#cant_parto_bovino").prop("disabled", false);
			$("#control_fecha").val("no_hay_fecha");
		//	$("#fecha_ult_parto").prop("disabled", false);
			

		} else {
			
			$("#fecha_ult_parto").prop("disabled", true);
			$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	$(document).on("change", "#cant_parto_bovino", function (e) {
		e.preventDefault();

		if ($("#cant_parto_bovino").val() >0 ) {
			$("#cant_parto_bovino").prop("disabled", true);
			$("#control_fecha").val("si_hay_fecha");

		}else{
			$("#cant_parto_bovino").prop("disabled", true);
			$("#fecha_ult_parto").prop("disabled", false);
		}
	});
	//cantida de parto se desabilita y fecha habilita si es 0 cant 

	$(document).on("change", "#tipo_bovino", function (e) {
		e.preventDefault();

		if ($("#tipo_bovino").val() == "vaca_lechera" ) {
			$("#cant_parto_bovino").prop("disabled", false);
			$("#control_fecha").val("no_hay_fecha");
		//	$("#fecha_ult_parto").prop("disabled", false);
			

		} else {
			
			//$("#fecha_ult_parto").prop("disabled", true);
			$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	$(document).on("change", "#cant_parto_bovino", function (e) {
		e.preventDefault();

		if ($("#cant_parto_bovino").val() >0 ) {
			$("#fecha_ult_parto").prop("disabled", false);
			$("#control_fecha").val("si_hay_fecha");

		}else{
			$("#cant_parto_bovino").prop("disabled", true);
			$("#fecha_ult_parto").prop("disabled", false);
		}
	});
	//sabilitados los dos al poner cero
	$(document).on("change", "#tipo_bovino", function (e) {
		e.preventDefault();

		if ($("#tipo_bovino").val() == "vaca_lechera" ) {
			$("#cant_parto_bovino").prop("disabled", false);
			$("#control_fecha").val("no_hay_fecha");
		//	$("#fecha_ult_parto").prop("disabled", false);
			

		} else {
			
			$("#fecha_ult_parto").prop("disabled", true);
			$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	$(document).on("change", "#cant_parto_bovino", function (e) {
		e.preventDefault();

		if ($("#cant_parto_bovino").val() >0 ) {
			$("#fecha_ult_parto").prop("disabled", false);
			$("#control_fecha").val("si_hay_fecha");

		}else{
			$("#cant_parto_bovino").prop("disabled", true);
				//	$("#fecha_ult_parto").prop("disabled", false);
		}
	});

	/// se guarda con cero y sin fecha y tambien con un numero 3
		$(document).on("change", "#tipo_bovino", function (e) {
		e.preventDefault();

		if ($("#tipo_bovino").val() == "vaca_lechera" ) {
			$("#cant_parto_bovino").prop("disabled", false);
			$("#control_fecha").val("no_hay_fecha");
		//	$("#fecha_ult_parto").prop("disabled", false);
			

		} else {
			
			$("#fecha_ult_parto").prop("disabled", true);
			$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	$(document).on("change", "#cant_parto_bovino", function (e) {
		e.preventDefault();

		if ($("#cant_parto_bovino").val() >0 ) {
			$("#fecha_ult_parto").prop("disabled", false);
			$("#control_fecha").val("si_hay_fecha");

		}else{
			//$("#cant_parto_bovino").prop("disabled", true);
		}
	});
	