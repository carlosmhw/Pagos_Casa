<?php 
if(!empty($_POST['user']) and !empty($_POST['pass'])){
	$db = new Conexion();
	$data_user = $db->real_escape_string($_POST['user']);
	$pass = Encrypt($_POST['pass']); 
	$sql = $db->query("SELECT id_user From user WHERE (email='$data_user' OR user = '$data_user') AND pass='$pass' LIMIT 1;");
	if($db->rows($sql)>0){
		$_SESSION['app_id'] = $db->recorrer($sql)[0];	
		echo 1;	//Tdo correcto 			
	}else{				
		echo 2;	// 2 Credenciales invalidas 
	}
	$db->liberar($sql);
	$db->close(); 
}else{
	echo 3; // 3 Todo los campos deben estar llenos 
}

?>