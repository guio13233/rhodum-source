<?php
	// If Cloudflare sent an IP, replace it.
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	$IP = $_SERVER['REMOTE_ADDR'];

	if (!isset($_GET['key'])) exit;
	if (is_array($_GET['key'])) exit;
	$key = $_GET['key'];

    if ($key != "sUPSxdraP3WsjDMC") {
        exit();
    }

	if (!isset($_GET['uid'])) exit;
	if (is_array($_GET['uid'])) exit;
	if (!is_numeric($_GET['uid'])) exit;
	$uid = $_GET['uid'];



	// Create database connection.
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		exit;
	}

	// Validate everything
	$stmt = $dbcon->prepare("SELECT port FROM games WHERE id=:uid;");
	$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $result['port'];

    $dbcon = null;

?>