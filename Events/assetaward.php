<?php

    if (!isset($_GET['key'])) exit('bruh no');
    if (!isset($_GET['name'])) exit;
	if (!isset($_GET['itemuid'])) exit;

    if ($_GET['key'] == '7as98uwiDS89BPGNRWKVDFHUEGOFHciq791358hg2fg80'){
        $good = 'yes';
    } else {
        exit('nah');
    }

    // variables

    $item = $_GET['itemuid'];
    $username = $_GET['name'];
    $itemtype = 'hats';
    $deleted = 0;
    $asset = 1;


    // start connection

    include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		echo $e->getMessage();
	}


    // get if from user
    $stmt = $dbcon->prepare("SELECT id FROM users WHERE username=:uid;");
	$stmt->bindParam(':uid', $username, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

    $user = $result['id'];

    // check if player has item

    $stm = $dbcon->prepare('select count(*) from `ownedItems` where `uid`=:column AND `catalogid`=:column2');
    $stm->bindParam(':column', $user, PDO::PARAM_INT);
    $stm->bindParam(':column2', $item, PDO::PARAM_INT);
    $stm->execute();
    $res = $stm->fetchColumn();

    if ($res > 0) {
        header("Content-Type: audio/mpeg"); 
        echo file_get_contents("sucess.mp3");
        exit();
    }
    else {
        header("Content-Type: audio/mpeg"); 
        echo file_get_contents("sucess.mp3");
    }



    // insert into database

	$stmt = $dbcon->prepare("INSERT INTO ownedItems (`uid`, `catalogid`, `type`, `deleted`, `rbxasset`) VALUES (:userid, :itemid, :type, :deleted, :rbxasset);");
	$stmt->bindParam(':userid', $user, PDO::PARAM_INT);
	$stmt->bindParam(':itemid', $item, PDO::PARAM_INT);
	$stmt->bindParam(':type', $itemtype, PDO::PARAM_STR);
	$stmt->bindParam(':deleted', $deleted, PDO::PARAM_INT);
	$stmt->bindParam(':rbxasset', $asset, PDO::PARAM_STR);
	$stmt->execute();
    

?>