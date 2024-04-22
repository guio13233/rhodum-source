<?php
    if (!isset($_GET['key'])) exit('Hello there XlXi, I wanted to remind you, your gay');

    if ($_GET['key'] == 'xlxigayandenergycellcool9974759797'){
        $good = 'yes';
    } else {
        exit('stop trying idiot');
    }
	if (!isset($_GET['hash'])) exit;
	$placeHash = $_GET['hash'];
    $placehashfilter = preg_replace("/^[a-zA-Z0-9]+$/", "", $placeHash);
	if (strpos($placeHash, 'rhodum.xyz') !== false) die("preset");
	//@unlink("/var/www/Rhodum/data/assets/uploads/".$placeHash);
	
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		echo $e->getMessage();
	}
	
	$aa = '%'.$placeHash.'%';
	$stmt = $dbcon->prepare("SELECT * FROM games WHERE `placeURL` LIKE :aa ORDER BY id DESC LIMIT 1;");
	$stmt->bindParam(':aa', $aa, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$id = $result['id'];
	
	$stmt = $dbcon->prepare("DELETE FROM renders WHERE render_id = :key AND type = 'server';");
	$stmt->bindParam(':key', $id, PDO::PARAM_STR);
	$stmt->execute();
	$dbcon = null;
	
	echo 'success';
?>