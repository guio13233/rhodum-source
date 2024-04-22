<?php 
error_reporting(0);
	if (isset($_GET['id'])) {
        $id1 = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        $goodblox = filter_var($id1,FILTER_SANITIZE_NUMBER_INT);
        $finobe = $res = preg_replace("/[^0-9.]/", "", "$goodblox");
        $ch = curl_init();
        // IMPORTANT: the below line is a security risk, read https://paragonie.com/blog/2017/10/certainty-automated-cacert-pem-management-for-php-software
        // in most cases, you should set it to true
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "https://assetdelivery.roblox.com/v1/assetId/$goodblox");
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);
        $newurl = $obj->location;
		$id = $_GET['id'];
        
		if (!is_numeric($id)) die("Invalid Request");
		if (is_array($id)) die("Invalid Request");
		if (filter_var($id, FILTER_VALIDATE_INT) == true && file_exists("files/$id")) {
				header("Content-Type: application/octet-stream");
				header("Content-Transfer-Encoding: Binary");
				header("Content-disposition: attachment; filename=".$id); 
				$url  = 'http://rhodum.xyz/asset/files/'.$id;
				$urlcontents = file_get_contents($url);
                echo $urlcontents;
		}else{
			header("Location: $newurl");
		}
	}else{
		exit('no');
	}
?>