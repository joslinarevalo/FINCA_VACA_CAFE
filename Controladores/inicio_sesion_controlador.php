<?php 
	@session_start();
	include_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_POST['desbloquear']) && $_POST['desbloquear']=="si_con_contrasena") {
		$sql = "SELECT 
					*FROM tb_empleado AS te
				JOIN tb_usuario as tu 
				ON tu.int_idempleado = te.int_idempleado
				WHERE (te.nva_email_empleado='$_SESSION[usuario]' OR tu.nva_nom_usuario = '$_SESSION[usuario]')
				";
		$resultado = $modelo->get_query($sql);
		if ($resultado[0]==1 && $resultado[4]==1) {
			$verificacion = $modelo->desencrilas_contrasena($_POST['contra_desbloqueo'],$resultado[2][0]['nva_contraseña_usuario']);
			if ($verificacion[0]===1) {
				$array = array("Exito","Bienvenido nuevamente ".$resultado[2][0]['nva_contraseña_usuario'],$resultado);
				$_SESSION['logueado']="si";
				$_SESSION['bloquear_pantalla']="no";
				print json_encode($array);

			}else{
				$array = array("Error","La contraseña no coincide",$resultado);
				print json_encode($array);
			}
		}else{
			$array = array("Error","Datos no existen",$resultado);
			print json_encode($array);
		}


	}else if (isset($_POST['validar_nuevo_pass']) && $_POST['validar_nuevo_pass']=="si_actualizalo") {

		$array_update = array(
            "table" => "tb_usuario",
            "id_persona" => $_POST['id_persona'],
            "contrasena"=>$modelo->encriptarlas_contrasenas($_POST['contrasena']),
             
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['validar_dui']) && $_POST['validar_dui']=="si_validalo") {

		$resultado = $modelo->get_todos("tb_persona","WHERE dui='".$_POST['dui']."'");
		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]['id'],$resultado,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['iniciar_sesion']) && $_POST['iniciar_sesion']=="si_nueva") {
		

		$sql = "SELECT 
					*FROM tb_empleado AS te
				JOIN tb_usuario as tu 
				ON tu.int_idempleado = te.int_idempleado
				WHERE (te.nva_email_empleado='$_POST[email_login]' OR tu.nva_nom_usuario = '$_POST[email_login]')";


		$resultado = $modelo->get_query($sql);
		if ($resultado[0]==1 && $resultado[4]==1) {
			$verificacion = $modelo->desencrilas_contrasena($_POST['contra_login'],$resultado[2][0]['nva_contraseña_usuario']);
			if ($verificacion[0]===1) {
				
				$_SESSION['logueado']="si";
				$_SESSION['bloquear_pantalla']="no";
				$_SESSION['empleado']=$resultado[2][0]['nva_nom_empleado'];				
				$_SESSION['usuario']=$resultado[2][0]['nva_nom_usuario'];
				$_SESSION['correo']=$resultado[2][0]['nva_email_empleado'];
				$_SESSION['idempleado']=$resultado[2][0]['int_idempleado'];

				$array = array("Exito","Bienvenido al sistema ".$resultado[2][0]['nva_nom_empleado'],$resultado,$_SESSION);
				print json_encode($array);
			}else{
				$array = array("Error","La contraseña no coincide",$resultado,$_SESSION);
				print json_encode($array);
			}
		}else{
			$array = array("Error","Datos no existen",$resultado);
			print json_encode($array);
		}
		


	}else{
		print json_encode(array("Error","No entro a ningun if"));
	}


?>