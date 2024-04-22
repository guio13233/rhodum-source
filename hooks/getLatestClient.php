<?php
	if (!isset($_GET['version']) || is_array($_GET['version'])) die("Invalid parameters");
	if (!isset($_GET['key'])) die("no-key");
	if (is_array($_GET['key'])) die("no-key");
	if ($_GET['key'] != "SCwQKQk2UICh0BUoD7LGx2NNRZJBZ1dj") die("invalid-key");
	if ($_GET['version'] == "2008") $filename = "Rhodum08_1.exe";
	if ($_GET['version'] == "2009") $filename = "Rhodum2009_installer.exe";
	if ($_GET['version'] == "2011") $filename = "Rhodum2011_v2_3.exe";
	
	if (!isset($filename) || strlen($filename) == 0) die("error");
	$file = file_get_contents("/var/www/api/downloads/".$filename);
	
	header("Content-disposition: attachment; filename=" . $filename);
	header("Content-type: application/octet-stream");
	echo $file;
?>