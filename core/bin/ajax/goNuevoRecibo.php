<?php 
	$db = new Conexion();
	$id_user = $db->real_escape_string($_POST['id_user']);
	$total_recibo = $db->real_escape_string($_POST['total_recibo']);
	$adeudo_persona = $db->real_escape_string($_POST['adeudo_persona']);
	$concepto = $db->real_escape_string($_POST['concepto']);
	$descripcion = $db->real_escape_string($_POST['descripcion']);
	$fecha = $db->real_escape_string($_POST['fecha']);
	
	if($db->query("INSERT INTO pago (concepto,descripcion,fecha_vencimiento,total_recivo,adeuto,id_user) VALUES('$concepto', '$descripcion', '$fecha', '$total_recibo', '$adeudo_persona',$id_user);")){
		echo "1";
	}else{
		echo "2";
	}
	

?>