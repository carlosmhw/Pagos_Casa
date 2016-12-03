<?php 
	function Users(){
		$db = new Conexion();
		$sql = $db->query("SELECT * from user;"); 
		if($db->rows($sql)>0){
			while($d = $db->recorrer($sql)){
				$user[$d['id_user']] = array(
					'id_user' => $d['id_user'],
					'user' => $d['user'],
					'email' => $d['email'],
					'nombre' => $d['nombre'],
					'ap_paterno' => $d['ap_paterno'],
					'ap_materno' => $d['ap_materno'],
					'pass' => $d['pass'],
					'permiso' => $d['permiso']
				);
			}
		}else{
			$user = false; 
		}
		$db->liberar($sql);
		$db->close();
		return $user; 
	}
?>