<?php
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		if (!is_numeric($id)) die("Invalid Request");
		if (is_array($id)) die("Invalid Request");
		if (filter_var($id, FILTER_VALIDATE_INT) == true && $_SERVER['HTTP_USER_AGENT'] == "Rhodum3") {
				header("Content-Type: application/octet-stream");
				header("Content-Transfer-Encoding: Binary");
				header("Content-disposition: attachment; filename=".$id); 
				$url  = 'http://labs.rhodum.xyz/Asset/files/'.$id;
				header("Location: ".$url);
		}else{
			echo 'Invalid Request';
		}
	}else{
		echo 'Invalid Request';
	}
?>