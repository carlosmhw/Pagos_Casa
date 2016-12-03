<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="views/img/favicons/favicon.ico">
	<!--<link rel="apple-touch-icon" sizes="120x120" href="views/img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="views/img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="views/img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="views/img/favicons/manifest.json">
	<meta name="theme-color" content="#ffffff">-->
	<meta name="viewport" content="width= device-width, user-scalable= no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>
	<?php 
		if(isset($_GET['view'])){
			
			switch ($_GET['view']) {
				case 'home':
					if(isset($_SESSION['app_id'])){
						echo APP_TITLE_HOME;
					}else{
						echo APP_TITLE_LOGIN;
					}					
					break;
				case 'administrar':
					echo APP_TITLE_ADMINISTRAR;										
					break;	
				case 'historial':
					echo APP_TITLE_HISTORIAL;	
					break;			
				default:
					echo APP_TITLE_ERROR;
					break;
			}
		}
	?>
	</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="views/css/estilo.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="views/js/generales.js"></script>	
	<script type="text/javascript" src="views/js/menu.js"></script>
</head>
