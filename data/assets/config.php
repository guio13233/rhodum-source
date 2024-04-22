<?php
	if (strpos($_SERVER['SCRIPT_NAME'], "config.php")) {
		header("Location: /");
		exit;
	}
	
	$db_host = "";
	$db_port = 3306;
	$db_name = "";
	$db_user = "";
	$db_passwd = "";
?>
