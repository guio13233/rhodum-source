<?php
	if (!isset($_GET['key'])) exit;
	if ($_GET['key'] != "UEJ0ekt1WF9nbGJmM31GLStVfE5TSlIsYzI-MzpqN08oLi9-azpxMGtFZi1fJW9PWXlvYi5sW1RWXlVuYyRV") exit;
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		echo $e->getMessage();
	}
	
    $serverid = 1;
	$stmt = $dbcon->prepare('SELECT * FROM serverRequests WHERE server=:servid ORDER BY id ASC LIMIT 1;');
    $stmt->bindParam(':servid', $serverid, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$sID = $result['id'];
	if ($stmt->rowCount() == 0) {
		echo 'no-request';
	}else{
		echo $result['placeLocation'].'-'.$result['serverVersion'].'-'.$result['userID'].'-'.$result['serverName'].'-'.$result['serverDescription'].'-'.$result['serverPrivacy'];
	}
	
	$stmt = $dbcon->prepare('DELETE FROM serverRequests WHERE id = :id');
	$stmt->bindParam(':id', $sID, PDO::PARAM_INT);
	$stmt->execute();
	
	$dbcon = null;
?>