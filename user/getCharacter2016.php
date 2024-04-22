<?php
	if (!isset($_GET['key']) || is_array($_GET['key']) || $_GET['key'] != "D869593BF742A42F79915993EF1DB") exit;
	
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.';charset=utf8', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		exit;
	}
	if (isset($_GET['uid'])) {
		$uid = $_GET['uid'];
		if (strlen($uid) == 0) {
			$dbcon = null;
			exit;
		}
		if (!is_numeric($uid)) {
			$dbcon = null;
			exit;
		}
	}else{
		$dbcon = null;
		exit;
	}
	if (isset($_GET['mode'])) {
		$mode = $_GET['mode'];
		$assetId = $_GET['sid'];
		if (!is_numeric($assetId)) {
			$dbcon = null;
			exit;
		}
		if ($mode == "shirts") {
			echo 'http://rhodum.xyz/data/assets/shirts/models/get.php?id='.$assetId;
			$dbcon = null;
			exit;
		}
		if ($mode == "pants") {
			echo 'http://rhodum.xyz/data/assets/pants/models/get.php?id='.$assetId;
			$dbcon = null;
			exit;
		}
		if ($mode == "ts") {
			echo 'http://rhodum.xyz/data/assets/tshirts/models/get.php?id='.$assetId;
			$dbcon = null;
			exit;
		}
		if ($mode == "ch") {
			#echo 'http://rhodum.xyz/data/assets/hats/models/invisible;';
		}
	}
	
	if (isset($_GET['dgear'])) {
		$disableGear = true;
	}else{
		$disableGear = false;
	}
	
	$stmt = $dbcon->prepare("SELECT id FROM users WHERE id=:uid;");
	$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
	$stmt->execute();
	if ($stmt->rowCount() == 0) {
		$dbcon = null;
		exit;
	}
	
	$stmt = $dbcon->prepare("SELECT * FROM `wearing` WHERE `uid` = :uid AND `type` = 'shirts' OR `uid` = :uido AND `type` = 'pants'");
    # SELECT * FROM `wearing` WHERE `uid` = :uid AND `type` = 'shirts' OR `uid` = :uid AND `type` = 'pants' OR `uid` = :uid AND `type` = 'tshirts'
	$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->bindParam(':uido', $uid, PDO::PARAM_INT);
	$stmt->execute();
	if ($stmt->rowCount() == 0) {
		#echo 'http://labs.rhodum.xyz/user/getcolors.php?uid='.$uid;
	}else{
		#echo 'http://labs.rhodum.xyz/user/getcolors.php?uid='.$uid.';';
	}
	$count = 0;
	foreach($stmt as $result) {
		if ($disableGear == true and $result['type'] == "gear") {
		}else{
			if ($count !== $stmt->rowCount()) {
				echo $result['aprString'].';';
			}else{
				echo $result['aprString'];
			}
		}
		$count++;
	}
	
	$dbcon = null;
?>