<?php  
	unset($_SESSION['app_id']);
	session_destroy();
	header('location: ?view=home&logout=success');
?>