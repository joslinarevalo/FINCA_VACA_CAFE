<?php 
	
	include("Conexion.php");
	try {
		
	
	$instancia = new Conexion();
	$conexion = $instancia->getDb();

	$sql ="SELECT * FROM tb_categoria";
	$statement = $conexion->prepare($sql);
	$statement->execute();
	$datos = $statement->fetchAll();

	print_r($datos);
 
	} catch (Exception $e) {
		print_r($e);
	}

?>