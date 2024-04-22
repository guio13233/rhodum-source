<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	if (isset($_GET['key'])) {
		$key = $_GET['key'];
	}else{
		$dbcon = null;
		exit(1);
	}
	
	$dedicatedServer = false; // Switch between user hosted server and a dedicated server
	if (isset($_GET['dedicated'])) $dedicatedServer = true;
	
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		echo $e->getMessage();
	}
	$stmtU = $dbcon->prepare("SELECT * FROM games WHERE `privatekey`=:key;");
	$stmtU->bindParam(':key', $key, PDO::PARAM_STR);
	$stmtU->execute();
	$dbcon = null;
	if ($stmtU->rowCount() == 0) {
		exit(2);
	}
	$rGame = $stmtU->fetch(PDO::FETCH_ASSOC);
    ?>
<?php
		echo htmlentities($rGame['placeURL'], ENT_QUOTES, "UTF-8");
?>