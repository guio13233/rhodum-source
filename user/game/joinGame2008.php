<?php
	// Check user agent and assign userID
	if (!isset($_GET['userID'])) exit;
	if (is_array($_GET['userID'])) exit;
	if (strlen($_GET['userID']) == 0) exit;
	if (!is_numeric($_GET['userID'])) exit;
	$uid = $_GET['userID'];
	
	// Check if key exists and validate it
	if (!isset($_GET['key'])) exit;
	if (is_array($_GET['key'])) exit;
	$key = $_GET['key'];
	
	//Check if gameID exists and validate it
	if (!isset($_GET['gameID'])) exit;
	if (strlen($_GET['gameID']) == 0) exit;
	if (is_array($_GET['gameID'])) exit;
	if (!is_numeric($_GET['gameID'])) exit;
	$gameId = $_GET['gameID'];
	
	include_once $_SERVER['DOCUMENT_ROOT'].'/user/enc.php';
	$script = file_get_contents('http://labs.rhodum.xyz/user/game/getScript2008.php?userID='.$uid.'&gameID='.$gameId.'&key=9cBOle3VIeU0wBfZmkL92qNU63xk8Y90&pkey='.$key);
	echo $script;
?>