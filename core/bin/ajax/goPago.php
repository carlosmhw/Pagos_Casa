<?php 
	$db = new Conexion();
	$id_user = $db->real_escape_string($_POST['id_user']);
	$id_pago = $db->real_escape_string($_POST['id_pago']);
	if($db->query("UPDATE pago SET estatus = 1 WHERE id_user = '$id_user' 
		AND id_pago = '$id_pago';")){
		echo "1";
	}else{
		echo "2";
	}
?>