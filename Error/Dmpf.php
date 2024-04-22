<?php

$file = htmlspecialchars($_GET["filename"]);



			$url = "https://discord.com/api/webhooks/853033390060208168/7tF17fYFbpwwpVVMPDDKdYkFHTCjkXLS4OPE9TDbbryV-RzHqLZN7fbhhT_RZm9_kiMP";
			$dataArray = array('content' => $file, 
			'username' => "Rhodum");
			
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
?>