<?php 
					$idproducto[] = isset($_POST['idproducto']);
					$cantidad[] = isset($_POST["cantidad"]);
					$costo_item[] = isset($_POST["costo_item_compra"]);
					$costo_total_item[] = isset($_POST["subtotal_guardar"]);	


					print_r($idproducto);
					print_r($cantidad);
					print_r($costo_item);
					print_r($costo_total_item);

?>