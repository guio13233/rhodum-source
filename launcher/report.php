<?php
	// If Cloudflare sent an IP, replace it.
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	$IP = $_SERVER['REMOTE_ADDR'];
	
	// Check if everything exists.
	if (!isset($_GET['report'])) exit;
	if (is_array($_GET['report'])) exit;
	$cheat = $_GET['report'];

        $verifycontent = 'Cheat '.'**'.$cheat.'**'.' was used by ip '.$IP;
		$url = "https://discord.com/api/webhooks/857554568871149569/skvA_X88cNMspajK4Y2isLjoco4dgxCDiwMTlRxful-A62FS0ihKku_z-CfpBqWIB8wl";
		$dataArray = array('content' => $verifycontent, 'username' => "Rhodum Game logs");
		
		$httpOptions = array(
			'http' => array (
				'header' => "Rhodum-Server",
				'content-type' => 'multipart/form-data',
				'method' => "POST",
				'content' => http_build_query($dataArray)
			)
		);
			
		$context = stream_context_create($httpOptions);
		$result = @file_get_contents($url, false, $context);
		echo 'yes';
?>