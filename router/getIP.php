<?php
	if (!isset($_GET['key'])) exit;
	if ($_GET['key'] != "UEJ0ekt1WF9nbGJmM31GLStVfE5TSlIsYzI-MzpqN08oLi9-azpxMGtFZi1fJW9PWXlvYi5sW1RWXlVuYyRV") exit;
	
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	echo $_SERVER['REMOTE_ADDR'];
?>