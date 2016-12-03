<?php 

	session_start();

	#Constantes de la app
	define('HTML_DIR', 'html/');
	define('APP_TITLE_LOGIN', 'Iniciar Sesión');
	define('APP_TITLE_HOME', 'Inicio');
	define('APP_TITLE_ERROR', 'Error 404 no encontrado');
	define('APP_TITLE_ADMINISTRAR', 'Administrar'); 


	#Constantes de la conexion a la base de datos
	/*define('DB_HOST', 'localhost');
	define('DB_USER', 'root'); 
	define('DB_PASS', '');
	define('DB_NAME', 'pagoscasa'); */

	define('DB_HOST', 'mysql.hostinger.mx');
	define('DB_USER', 'u163675083_admin'); 
	define('DB_PASS', 'jtiaXpmuk_045.H');
	define('DB_NAME', 'u163675083_pagos');


	require('core/models/class.Conexion.php'); 
	require('core/bin/functions/Encrypt.php'); 
	require('core/bin/functions/Users.php'); 
	require('core/bin/functions/getIp.php');

	$users = Users(); 
	

?>