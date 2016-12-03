<?php 
	if(!isset($_GET['view'])){
		header('location: ?view=home');
	}
?>
<!DOCTYPE html>
<html lang="es">
<?php include(HTML_DIR . 'overall/head.php');?>
<body>

<?php include(HTML_DIR . 'overall/header.php') ?>



<section class="container">

<?php 
	if(!isset($_SESSION['app_id'])){
		echo '
			<div class="header-movil">
				<h2>JUNIO 21</h2>
			</div>';
		include(HTML_DIR . '/public/login.php');
	}else{	
		$permiso = $users[$_SESSION['app_id']]['permiso'];  
		if($permiso == 1){
			include(HTML_DIR . '/content/menu/menuAdmin.php');
			include(HTML_DIR . '/content/historial/historial_content.php');
		}else if($permiso == 2){
			include(HTML_DIR . '/content/menu/menuNoAdminNoCasa.php');
			include(HTML_DIR . '/content/historial/historial_content.php');
		}else{
			include(HTML_DIR . '/content/menu/menuNoAdmin.php');
			include(HTML_DIR . '/content/historial/historial_content.php');
		}

		
		
	}
?>

</section>
</body>
</html>
