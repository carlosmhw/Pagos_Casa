<?php 
	function Encrypt($string){
		$long = strlen($string); 
		$str = '';
		for($x = 0; $x <$long; $x++){
			$str .= ($x % 2) != 0 ? sha1($string[$x]) : $x;
		}
		return sha1($str); 
	}
?>