<?php
	if (!isset($_GET['serverKey'])) exit;
	if (!isset($_GET['key'])) exit;
	if ($_GET['key'] != "UEJ0ekt1WF9nbGJmM31GLStVfE5TSlIsYzI-MzpqN08oLi9-azpxMGtFZi1fJW9PWXlvYi5sW1RWXlVuYyRV") exit;
	$serverKey = $_GET['serverKey'];
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		echo $e->getMessage();
	}
	
	$stmt = $dbcon->prepare('DELETE FROM games WHERE privatekey = :key;');
	$stmt->bindParam(':key', $serverKey, PDO::PARAM_STR);
	$stmt->execute();
	echo 'success';
	$dbcon = null;
?>