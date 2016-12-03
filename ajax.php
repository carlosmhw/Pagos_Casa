<?php 
	if($_POST){
		require('core/core.php');
		switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
			case 'login':
				require('core/bin/ajax/goLogin.php'); 
				break;	
			case 'nuevoRecibo':
				require('core/bin/ajax/goNuevoRecibo.php'); 
				break;
			case 'pago':
				require('core/bin/ajax/goPago.php'); 
				break;
			default:
				header('location: index.php'); 
				break;
		}
	}else{
		header('location: index.php'); 
	}

?>